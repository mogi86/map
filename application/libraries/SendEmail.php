<?php

/**
 * メール送信ライブラリ
 *
 */
class SendEMail{
    
    /**
     * SendGridオブジェクト
     * 
     * @var SendGrid
     */
    private $sendgrid;
    
    /**
     * Emailオブジェクト
     * 
     * @var Email
     */
    private $email;
    
    /**
     * TO宛メールアドレス
     * 
     * @var string
     */
    private $to_address;
    
    /**
     * 送信元メールアドレス
     * 
     * @var string
     */
    private $from_address;
    
    /**
     * 題名
     * 
     * @var string
     */
    private $subject;
    
    /**
     * メール本文
     * 
     * @var string
     */
    private $text;
    
    /**
     * 添付ファイル
     * 
     * @var string
     */
    private $file_name;
    
    public function __construct()
    {
        
        $this->sendgrid = new SendGrid(getenv('SENDGRID_USERNAME'), getenv('SENDGRID_PASSWORD'));
        $this->email = new SendGrid\Email();
        
    }
    
    /**
     * 宛先設定(TO宛)
     * 
     * @param string TO宛メールアドレス
     */
    public function setToAddress($to_address)
    {
        $this->to_address = $to_address;
    }
    
    /**
     * 送信元メールアドレス設定
     * 
     * @param string 送信元メールアドレス
     */
    public function setFromAddress($from_address)
    {
        $this->from_address = $from_address;
    }
    
    /**
     * 題名設定
     * 
     * @param string 題名
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
    /**
     * メール本文設定
     * 
     * @param string メール本文
     */
    public function setText($text)
    {
        $this->text = $text;
    }
    
    /**
     * 添付ファイル設定
     * 
     */
    public function setAttachment($file_name){
        
        $this->file_name = $file_name;
        
    }
    
    /**
     * メール送信
     * 
     */
    public function send()
    {
        $this->email->addTo($this->to_address)->setFrom($this->from_address)->setSubject($this->subject)->setText($this->text);
        $this->sendgrid->send($this->email);
    }
    
    /**
     * メール送信(添付ファイルあり)
     *
     */
    public function sendAttachment()
    {
        $this->email->addTo($this->to_address)->setFrom($this->from_address)->setSubject($this->subject)->setText($this->text)->addAttachment($this->file_name);
        $this->sendgrid->send($this->email);
    }
    
    public function reset(){
        unset($this->email);
        $this->email = new SendGrid\Email();
    }
    
}
