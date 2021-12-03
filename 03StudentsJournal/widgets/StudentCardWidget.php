<?php

namespace app\widgets;
use yii\base\Widget;

// watch widget in views/students/show-student.php:5
class StudentCardWidget extends Widget
{
    public $firstName;
    public $lastName;
    public $age;
    public $rating;
    public $theme;

    private $activeThemeStyle;
    private $activeteTextStyle;

    public function init()
    {
        parent::init();

        if ($this->firstName === null) {
            $this->firstName = 'Unknown firstName';
        }
        if ($this->lastName === null) {
            $this->lastName = 'Unknown lastName';
        }
        if ($this->age === null) {
            $this->age = 'Unknown age';
        }
        if ($this->rating === null) {
            $this->rating = 'Unknown rating';
        }

        // theme
        $this->activeThemeStyle = 'font-size: 22px;';
        switch ($this->theme) {
            case 'special':
                $this->activeThemeStyle .= 'border: 1px solid red; box-shadow: 0px 5px 10px 2px rgba(355, 0, 0, 0.2) inset;';
                $this->activeteTextStyle = "style='color: rgba(255, 99, 71, 1)'";
                break;
            case null:
            case 'default':
                $this->activeThemeStyle .= 'border: 1px solid grey; box-shadow: 0px 5px 10px 2px rgba(120, 120, 120, 0.2) inset;';
                $this->activeteTextStyle = "style='color: grey'";
            break;
        }
    }

    public function run() {
        $fontSizeSmall = "style='font-size: 16px'";
        $content = "<div class='text-center mt-5' style='$this->activeThemeStyle'>";
            $content .= "<h1 class='mt-5' $this->activeteTextStyle>".$this->lastName.' '.$this->firstName."</h1>";
            $content .= "<p class='mt-5' ><span $fontSizeSmall>age:</span>".' '.$this->age."</p>";
            $content .= "<p><span $fontSizeSmall>rating:</span>".' '.$this->rating."</p>";
        $content .= '</div>';
        return $content;
    }
}