<?php

/**
 * ID、パスワード作成クラス
 */
class CreateIdPassword {
    
    /**
     * IDの長さ
     * 
     * @var int
     */
    const LENGTH_ID = 10;
    
    /**
     * パスワードの長さ
     *
     * @var int
     */
    const LENGTH_PASS = 10;
    
    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }
    
    /**
     * 人数分のID、パスワード作成
     * 
     * @param int 作成数
     * @return array ID、パスワードリスト
     */
    public function getIdPassword($num)
    {
        
        $id_pass_list = array();
        
        for ($i = 0; $i < $num; $i++) {
            $id_pass_list[$i]['id'] = $this->makeRandStr(self::LENGTH_ID);
            $id_pass_list[$i]['pass'] = $this->makeRandStr(self::LENGTH_PASS);
        }
        
        //重複が無い場合
        if ($this->checkRepeated($id_pass_list) === true) {
            
            return $id_pass_list;
            
        //重複がある場合
        } else {
            return false;
        }
        
    }
    
    /**
     * ID、パスワード生成
     *
     * @param int 文字列長さ
     * @return String ランダム文字列
     */
    private function makeRandStr($length)
    {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = null;
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }
    
    /**
     * ID、パスワード重複チェック
     *
     * @param array ID、パスワードリスト
     * @return boolean チェック結果(true:重複なし、false:重複あり)
     */
    private function checkRepeated($id_pass_list){
         
        $result = false;
        $check_list = array();
         
        foreach ($id_pass_list as $row) {
            $check_list[] = $row['id'];
            $check_list[] = $row['pass'];
        }
         
        $unique_array = array_unique($check_list);
        if (count($unique_array) === count($check_list)) {
            $result = true;
        }
        else {
            $result = false;
        }
         
        return $result;
    }
    
}
