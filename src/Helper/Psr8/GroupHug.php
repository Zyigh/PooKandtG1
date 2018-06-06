<?php
/**
 * Created by PhpStorm.
 * User: Zyigh
 * Date: 06/06/2018
 * Time: 17:11
 */

namespace Zyigh\App\Helper\Psr8;


use Psr\Hug\GroupHuggable;
use Psr\Hug\Huggable;

abstract class GroupHug implements GroupHuggable
{
    public $huggers = [];

    /**
     * GroupHug constructor.
     * Also an optional constructor to have a lot of huggers to hug only one Huggable
     * Note that Huggables only hug Huggable
     *
     * @param array|null $huggables
     * @throws NotHuggableException
     */
    public function __construct(?array $huggables = null)
    {
        if (!is_null($huggables)) {
            foreach ($huggables as $huggable) {
                if (!($huggable instanceof Huggable)) {
                    throw new NotHuggableException(
                        sprintf("%s is not Huggable",
                            end(implode("\\", get_class($huggable))))
                    );
                } else {
                    $this->huggers[] = $huggable;
                }
            }
        }
    }

    public function hug(Huggable $h)
    {
        if (count($this->huggers) > 0) {
            foreach ($this->huggers as $hugger) {
                $hugger->hug($h);
            }
        }
    }

    public function groupHug($huggables)
    {
        $hs = $huggables->huggers;

        $problems = null;
        foreach ($hs as $huggable) {
            if (!($huggable instanceof Huggable)) {
                $problems = get_class($huggable);
                break;
            }
            foreach ($this->huggers as $hugger) {
                if (!($hugger instanceof Huggable)) {
                    $problems = get_class($huggable);
                    break 2;
                }
                $hugger->hug($huggable);
            }
        }
        if (!is_null($problems)) {
            throw new NotHuggableException(
                sprintf("%s is not Huggable",
                    end(implode("\\", $problems)))
            );
        }
    }

    public function hugBack(Huggable $h)
    {
        if (is_null($this->huggers) || count($this->huggers) < 0) { throw new NotHuggableException("There is nobody to hug..."); }
        foreach ($this->huggers as $hugger) {
            $hugger->enjoy();
            $h->enjoy();
        }
    }

    public function enjoy()
    {
        if (is_null($this->huggers) || count($this->huggers) < 0) { throw new NotHuggableException("There is nobody to hug..."); }
        foreach ($this->huggers as $hugger) {
            $hugger->enjoy();
        }
    }
}