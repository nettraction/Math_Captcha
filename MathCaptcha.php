<?php

/** 
 * PHP-based Simple Math Captcha
 * 
 * @version 1.0
 * @author Nettraction <dev@nettraction.in>
 * 
 */
Class MathCaptcha{
  
  private $min;
  private $max;
  
  private $session_var;

  private $result;
  private $operand1;
  private $operand2;
  private $operator;
  
  private $op_symbols = array('+', '-', '*');
      
  function __construct($sess_var='math_captcha_result', $min_val=0, $max_val=10) {
    
    $this->min = ($min_val<=0) ? 0 : $min_val;
    $this->max = ($max_val<=$this->min) ? 10 : $max_val;
    
    if( !empty($sess_var) ){
      $this->session_var = $sess_var;
    }else{
      $this->session_var = 'math_captcha_result';
    }

  }
  
  public function reset_captcha(){
    
    $this->operand1 = rand($this->min, $this->max);
    $this->operand2 = rand($this->min, $this->max);
    $this->operator = $this->op_symbols[rand(0, (count($this->op_symbols)-1))];
    
    $this->compute_result();
    
    // Save to $_SESSION
    $_SESSION[$this->session_var] = $this->result;
  }
  
  private function compute_result() {
    
    switch ($this->operator){
      case '+':
        $this->result = ($this->operand1 + $this->operand2);
        break;
      
      case '-':
        $this->result = ($this->operand1 - $this->operand2);
        break;
      
      case '*':
        $this->result = ($this->operand1 * $this->operand2);
        break;
    }
  }
  
  public function validate($val){
    if( $val == $_SESSION[$this->session_var] ){
      return TRUE;
    }else{
      return FALSE;
    }
  }
  
  public function get_captcha_text($format='%d %s %d'){
    if(!empty($format)){
      return sprintf($format, $this->operand1, $this->operator, $this->operand2);
    }else{
      return sprintf("%d %s %d", $this->operand1, $this->operator, $this->operand2);
    }
  }
}