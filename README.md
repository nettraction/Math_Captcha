Math_Captcha
============

PHP-based Simple Math Captcha

Usage
=====

1. Include the file. (Note: `session_start()` must be called before instantiating this class)

  ```php
  require_once 'MathCaptcha.php';
  ```

2. Instantiate MathCaptcha 

  ```php
  $cpa = new MathCaptcha();
  ```

3. First call to the page (before user submit)

  ```php
  if( /* is this a submit? */ ){
    $captcha_val = $_REQUEST['captcha'];
  
    if( $cpa->validate($captcha_val) ){
      echo 'Correct';
    }else{
      echo 'Incorrect';
    }
  }else{
    // Initialize captcha
    $cpa->reset_captcha();
  }
  ```

4. Display Captcha/Challenge text within a form (using `get_captcha_text()` method)

  *Simple*
  ```php
  echo 'Solve this simple Math: ' . $cpa->get_captcha_text() . " = ?";
  ```
  
  *Custom Text*
  ```php
  $captcha_text = 'Result of <i>{operand1}</i> {operator} <i>{operand2}</i> is?';
  echo $cpa->get_captcha_text($captcha_text);
  ```
