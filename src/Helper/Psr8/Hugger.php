<?php
/**
 * Created by PhpStorm.
 * User: Zyigh
 * Date: 06/06/2018
 * Time: 16:32
 */

namespace Zyigh\App\Helper\Psr8;

use Psr\Hug\Huggable;

/**
 * Class Hugger
 * @package Zyigh\App\Helper\Psr8
 * Abstract class with basic implementation of PSR-!
 *
 * @Todo : Prevent self hugging
 */
abstract class Hugger implements Huggable
{
    /**
     * @var int level of enjoyement
     */
    protected $enjoyement = 0;
    /**
     * @var array should be written [String]
     * Different reactions to hug
     */
    protected $reaction = [
        "Mmmmmmmmh..." . PHP_EOL,
        "Ooooooooh !!!" . PHP_EOL,
        "AAAAAAAH !!!!!" . PHP_EOL,
        "GEAAAAGH !! Ggeg... GIGHPHBH !!! Mimph... AAAAAAAAAAAAAAAAAAA !!!" . PHP_EOL,
    ];

    public function enjoy()
    {
        if (++$this->enjoyement < 3) {
            $reaction = 0;
        } elseif ($this->enjoyement < 5) {
            $reaction = 1;
        } elseif ($this->enjoyement < 8) {
            $reaction = 2;
        } else {
            $reaction = 3;
        }
        echo $this->reaction[$reaction];
    }

    public function hug(Huggable $h)
    {
        $h->hugBack($this);
    }

    public function hugBack(Huggable $h)
    {
        $this->enjoy();
        $h->enjoy();
    }
}