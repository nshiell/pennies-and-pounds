<?php

namespace Nshiell;

/**
 * A class for calculating the minimum number of
 * Sterling coins needed to make an amount.
 */
class Wallet
{
    protected $amount;
 
    protected $avaliableCoins = [
        'X2'  => 200,
        'X1'  => 100,
        '50p' => 50,
        '20p' => 20,
        '2p'  => 2,
        '1p'  => 1
    ];
    
    /**
     * Will return an integer number of pennies based on a human value
     * e.g. 5p
     *      £20.123
     * 
     * @return Int number of pennies
     */
    public function setAmountRaw($raw)
    {
        $isPound = false;
        if (substr($raw, -1) == 'p') {
            $raw = substr($raw, 0, -1);
        }

        //if (mb_substr($raw, 0, 1, 'UTF-8') == '£') {die("KKKK\n");
        if (strpos($raw, '£') === 0) {
            //$raw = substr($raw, 1);
            $raw = mb_substr($raw, 1, strlen($raw), 'UTF-8');
            $isPound = true;
        }

        if (strpos($raw, '.') !== false) {
            $isPound = true;
        }
        
        // Think about
        $raw = (is_numeric($raw)) ?
            (float) $raw
            : 0;
        
        if ($isPound) {
            $raw = $raw * 100;
        }

        $raw = round($raw);
        
        $this->amount = $raw;
        
        return $this;
    }

    /**
     * Will return an integer number of pennies based on a human value
     * e.g. 5p
     *      £20.123
     * 
     * @return Int number of pennies
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Will calculate which coins are needed to represent the amount set
     * Will work out the smallest set of coins needed
     * 
     * @return array [
     *          'X2' => x
     *          'X1' => x,              '20p' => 1,
     *          '2p'  => x,
     *          '1p'  => x]
     */
    public function getCoins()
    {
        if (!$this->amount) {
            return [];
        }
        
        $money = [];
        foreach ($this->avaliableCoins as $coin => $value) {
            if ($this->amount >= $value) {
                $money[$coin] = (int) floor($this->amount / $value);
                $this->amount-= ($money[$coin] * $value);
    
                if (!$this->amount) {
                    return $money;
                }
            }
        }
        
    }
}