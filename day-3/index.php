<?php

// --- Day 3: Rucksack Reorganization ---
// One Elf has the important job of loading all of the rucksacks with supplies for the jungle journey. Unfortunately, that Elf didn't quite follow the packing instructions, and so a few items now need to be rearranged.

// Each rucksack has two large compartments. All items of a given type are meant to go into exactly one of the two compartments. The Elf that did the packing failed to follow this rule for exactly one item type per rucksack.

// The Elves have made a list of all of the items currently in each rucksack (your puzzle input), but they need your help finding the errors. Every item type is identified by a single lowercase or uppercase letter (that is, a and A refer to different types of items).

// The list of items for each rucksack is given as characters all on a single line. A given rucksack always has the same number of items in each of its two compartments, so the first half of the characters represent items in the first compartment, while the second half of the characters represent items in the second compartment.

// For example, suppose you have the following list of contents from six rucksacks:

// vJrwpWtwJgWrhcsFMMfFFhFp
// jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
// PmmdzqPrVvPwwTWBwg
// wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
// ttgJtRGJQctTZtZT
// CrZsJsPPZsGzwwsLwLmpwMDw

// The first rucksack contains the items vJrwpWtwJgWrhcsFMMfFFhFp, which means its first compartment contains the items vJrwpWtwJgWr, while the second compartment contains the items hcsFMMfFFhFp. The only item type that appears in both compartments is lowercase p.
// The second rucksack's compartments contain jqHRNqRjqzjGDLGL and rsFMfFZSrLrFZsSL. The only item type that appears in both compartments is uppercase L.
// The third rucksack's compartments contain PmmdzqPrV and vPwwTWBwg; the only common item type is uppercase P.
// The fourth rucksack's compartments only share item type v.
// The fifth rucksack's compartments only share item type t.
// The sixth rucksack's compartments only share item type s.
// To help prioritize item rearrangement, every item type can be converted to a priority:

// Lowercase item types a through z have priorities 1 through 26.
// Uppercase item types A through Z have priorities 27 through 52.
// In the above example, the priority of the item type that appears in both compartments of each rucksack is 16 (p), 38 (L), 42 (P), 22 (v), 20 (t), and 19 (s); the sum of these is 157.

// Find the item type that appears in both compartments of each rucksack. What is the sum of the priorities of those item types?


class Rucksack {
    public $inventory;
    public $compartment_1;
    public $compartment_2;

    function __construct($inventory)
    {
        $this->inventory = $inventory;
        $this->compartment_1 = str_split(substr($inventory, 0, strlen($inventory)/2));
        $this->compartment_2 = str_split(substr($inventory, strlen($inventory)/2));
    }

    function get_compartment_1(){
        return $this->compartment_1;
    }

    function get_compartment_2(){
        return $this->compartment_2;
    }

    //Returns the character the is present in both compartments of the rucksack
    function get_duplicate(){
        $dublicate_char = null;
        foreach($this->compartment_1 as $char_1) {
            foreach($this->compartment_2 as $char_2) {
                if ($char_1 === $char_2) {
                    $dublicate_char = $char_1;
                    break;
                }
            }
            if ($dublicate_char != null) {
                break;
            }
        }
        return $dublicate_char;
    }
}





$file = fopen("input.txt", "r");

if ($file) {
    $rucksacks  = [];

    //Creates an instance of Rucksack Object for each line in the input file and stores it in an array
    while(($line = fgets($file)) != false) {
         array_push($rucksacks, new Rucksack(rtrim($line)) );
    }
    
    //Calculates the items priority

    $priority_sum = 0;
    
    foreach($rucksacks as $sack) {
        $duplicate_item = $sack->get_duplicate();
        //Checks if the dublicate character is upper or lower case
        if (ctype_upper($duplicate_item)) {
            $priority_sum += ord($duplicate_item) - 38;
        } else {
            $priority_sum += ord($duplicate_item) - 96;
        }
    }
    
    echo $priority_sum;


    
}