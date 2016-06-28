<?php

/**
 * ベースURL作成クラス
 *
 */
class BaseUrl{
    
    /**
     * ベースURL
     * 
     * @var string
     */
    private $base_url;
    
    /**
     * インスタンス
     * 
     * @var string
     */
    private $instance;
    
    /**
     * コンストラクタ
     *   ※シングルトン
     */
    private function __construct()
    {
        
        $scheme = isset($_SERVER['HTTPS']) === true ? 'https' : 'http';
        $this->base_url = $scheme.'://'.$_SERVER['SERVER_NAME'];
        
    }
    
    public static function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
    
    /**
     * ベースURL取得
     * 
     * @return string ベースURL
     */
    public function getBaseUrl(){
        
        return $this->base_url;
        
    }
    
}