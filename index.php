<?php
/**
 * Created by PhpStorm.
 * User: yahweh
 * Date: 2017/10/26
 * Time: 下午5:44
 */

interface Joseph
{
    public function handle($num=0, $step=0, $survivors = 0);
}

class Stackjsoeph implements Joseph
{
    public $num;
    public $stack;
    public function __construct(StackArray $stack)
    {
        $this->stack = $stack;
    }

    public function handle($num = 0, $step = 0, $survivors = 0)
    {
        // TODO: Implement handle() method.
        # 建立栈
        $this->stack->buildStack($num);
        $i = 0;
        while($this->stack->size > $survivors)
        {
            $item = $this->stack->pop();
            if(($i+1) % $step !== 0)
            {
                $this->stack->push($item);
                $i++;
            }
            else
            {
                $i = 0;
            }
        }
        return $this->stack->stack();
    }
}


class StackArray
{
    public $size;
    public $stack = [];

    public function buildStack($num)
    {
        $this->size = $num;
        $index = 0;
        while ($index++ < $this->size)
        {
            $this->stack[] = $index;
        }
        // var_dump($this->stack);
    }

    public function stack()
    {
        return $this->stack;
    }

    public function pop()
    {
        $item = array_shift($this->stack);
        $this->size = count($this->stack);
        return $item;
    }

    public function push($item)
    {
        $this->stack[] = $item;
        $this->size = count($this->stack);
    }
}


$arrayStack = new StackArray();
$joseph = new Stackjsoeph($arrayStack);
$r = $joseph->handle(100001, 3, 2);
var_dump($r);
