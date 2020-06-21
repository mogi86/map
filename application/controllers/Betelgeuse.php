<?php

/**
 * メインクラス
 *
 *
 */
class Betelgeuse extends CI_Controller {

    /**
     * 図書館API
     *
     * @var string
     */
    const LIBRARY_API = 'LIBRARY_API';

    /**
     * 楽天API
     * 
     * @var string
     */
    const RAKUTEN_API = 'RAKUTEN_API';

    /**
     * コンストラクタ
    */
    public function __construct()
    {

        parent::__construct();

    }

    /**
     * 地図ページ
     */
    public function index()
    {
        $this->load->view('map');
    }

    /**
     * 図書館ページ
     */
    public function library()
    {;
        //GETパラメータ取得
        $get_param = $this->input->get();
         
        //緯度
        $lat = htmlentities($get_param['lat'], ENT_QUOTES, "UTF-8");
        //経度
        $lng = htmlentities($get_param['lng'], ENT_QUOTES, "UTF-8");
        
        $library_api_key = $this->getApiKey(self::LIBRARY_API);
         
        $library_api_url = 'http://api.calil.jp/library';
        $query = array(
            'appkey' => $library_api_key,
            'geocode' => "{$lng},{$lat}",
            'format' => 'json',
            'callback' => '',
        );

        $response = file_get_contents("{$library_api_url}?" . http_build_query($query));
        $result = json_decode($response, true);
        $data = array(
            'library_data' => $result,
        );
         
        $this->load->view('library', $data);
         
    }

    /**
     * 書籍・図書館貸し出し状況検索ページ
     */
    public function searchBook()
    {

        $isbn_list = array();
        $book_map = array();
        $libkey_list = array();
        $library_map = array();
        
        //GETパラメータ取得
        $get_param = $this->input->get();

        //検索書籍名
        $book_name = htmlentities($get_param['book_name'], ENT_QUOTES, "UTF-8");

        foreach ($get_param['system_id'] as $index => $value) {
            //システムID
            $system_id_list[] = htmlentities($value, ENT_QUOTES, "UTF-8");
            //図書館マッピング
            $library_map[htmlentities($value, ENT_QUOTES, "UTF-8")] = htmlentities($get_param['formal'][$index], ENT_QUOTES, "UTF-8");
        }
        $system_id = implode(',', $system_id_list);
        
        $rakuten_api_key = getenv('RAKUTEN_API');

        $rakuten_api_url = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404';
        $query = array(
            'format' => 'json',
            'title' => $book_name,
            'applicationId' => $rakuten_api_key
        );
        
        $response = file_get_contents("{$rakuten_api_url}?" . http_build_query($query));
        $result = json_decode($response, true);

        //HITした書籍分ISBNで貸出状況を取得する
        foreach ($result['Items'] as $row) {
            
            $book_map[$row['Item']['isbn']] = $row['Item']['title'];

            //ISBNリスト作成
            $isbn_list[] = $row['Item']['isbn'];
            
        }
        
        $isbn = implode(',', $isbn_list);
        $library_info = $this->getLibraryLoanInfo($system_id, $isbn);

        foreach ($library_info['books'] as $isbn => $system_id_list) {
            
            foreach ($system_id_list as $system_id_index => $row) {
                
                //貸出状況が取得できている場合
                if (!empty($row['libkey'])) {
                    $libkey_list[$book_map[$isbn]]['formal'] = $library_map[$system_id_index];
                    $libkey_list[$book_map[$isbn]]['libkey'] = $row['libkey'];
                }
                
            }
            
        }
        
        $data = array(
            'result' => $libkey_list,
        );
         
        $this->load->view('result', $data);
        
        //var_dump($libkey_list);

    }
    
    /**
     * 図書館貸出状況取得
     * APIを使ってシステムIDとISBNから貸出状況を取得する
     * 
     * @param string $systemid システムID
     * @param string $isbn ISBN
     * @return array $result 貸出状況
     */
    private function getLibraryLoanInfo($system_id, $isbn)
    {
        
        $library_api_key = $this->getApiKey(self::LIBRARY_API);
        
        $library_api_url = 'http://api.calil.jp/check';
        $query = array(
            'appkey' => $library_api_key,
            'isbn' => $isbn,
            'systemid' => $system_id,
            'format' => 'json',
            'callback' => '',
        );
        
        $response = file_get_contents("{$library_api_url}?" . http_build_query($query));
        $result = json_decode(trim($response, '();'), true);
        
        $continue = $result['continue'];
        $session = $result['session'];
        
        //while ($continue == 1) {
            
            $query = array(
                'appkey' => $library_api_key,
                'session' => $session,
                'format' => 'json',
                'callback' => '',
            );
            
            //var_dump("{$library_api_url}?" . http_build_query($query));
            
            $response = file_get_contents("{$library_api_url}?" . http_build_query($query));
            $result = json_decode(trim($response, '();'), true);
            //$session = $result['session'];
            $continue = $result['continue'];
        //}
        
        return $result;
        
    }
    
    /**
     * APIのキーを取得
     * 
     * @param string APIの名称
     * @return string APIキー
     */
    private function getApiKey($api_name)
    {
        
        $json_data = file_get_contents(APPPATH . "json/api_info.json");
        $data = json_decode($json_data, true);
        
        if (array_key_exists($api_name, $data)) {
            return $data[$api_name];
        } else {
            return '';
        }
        
    }

}