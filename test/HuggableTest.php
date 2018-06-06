<?php
/**
 * Created by PhpStorm.
 * User: Zyigh
 * Date: 06/06/2018
 * Time: 17:35
 */

namespace Zyigh\Test;

use PHPUnit\Framework\TestCase;
use Zyigh\App\Helper\Psr8\GroupHug;
use Zyigh\App\Helper\Psr8\Hugger;

class Hooman extends Hugger {}
class Sheep extends Hugger {}
class Alien extends Hugger {}
class HoomanAndSheepWaitingForAliens extends GroupHug {}
class AlienTryingToGetLaid extends GroupHug {}

class HuggableTest extends TestCase
{
    public $hooman = null;
    public $sheep = null;
    public $alien = null;
    public $hoomanAndSheepWaitingForAliens = null;
    public $alienTryingToGetLaid = null;

    public function setup()
    {
        $this->hooman = $this->hooman ?? new Hooman();
        $this->sheep = $this->sheep ?? new Sheep();
        $this->alien = $this->alien ?? new Alien();
        $this->hoomanAndSheepWaitingForAliens = $this->hoomanAndSheepWaitingForAliens ?? new HoomanAndSheepWaitingForAliens(
            [$this->hooman, $this->sheep]
        );
        $this->alienTryingToGetLaid = $this->alienTryingToGetLaid ?? new AlienTryingToGetLaid(
            [$this->alien, $this->sheep]
        );
    }

    public function testSingleHugs()
    {
        try {
            $this->setup();
            $this->alien->hug($this->hooman);
            $this->hooman->hug($this->sheep);
            $this->sheep->hug($this->hooman);
            $this->alien->hug($this->hooman);
            $this->hooman->hug($this->sheep);
            $this->sheep->hug($this->hooman);
            $this->alien->hug($this->hooman);
            $this->hooman->hug($this->sheep);
            $this->sheep->hug($this->hooman);
            $this->alien->hug($this->hooman);
            $this->hooman->hug($this->sheep);
            $this->sheep->hug($this->hooman);
            $this->alien->hug($this->hooman);
            $this->hooman->hug($this->sheep);
            $this->sheep->hug($this->hooman);
            $this->alien->hug($this->hooman);
            $this->hooman->hug($this->sheep);
            $this->sheep->hug($this->hooman);
        } catch (\Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testHugs()
    {
        try {
            $this->setup();
            $this->hoomanAndSheepWaitingForAliens->hug($this->alien);
            $this->alienTryingToGetLaid->groupHug($this->hoomanAndSheepWaitingForAliens);
        } catch (\Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}