<?php
/**
 * Interface for a kitchen blender
 */


/**
 * @invariant 0 <= getSpeed() <= 9 // Range check
 * 
 * @invariant getSpeed() > 0 implies isFull()  // Don't run empty
 *
 */
interface BlenderInterface {

/**
 * @return int current speed
 *
 */
public function getSpeed();

/**
 * @pre abs(getSpeed() - x) <= 1 // only change by one
 *
 * @pre 0 <= $speed <= 9
 *
 * @post getSpeed() == $speed
 *
 * @param int $speed
 *
 */
public function setSpeed($speed);

/**
  * Verfies if the blender is full
  *
  * @return bool 
 */
public function isFull();


/**
 * fills the blender
 *
 * @pre isFull == false  // fill only if empty
 *
 * @post isFull == true
 *
 */
public function fill();

/**
 * empty the blender
 *
 * @pre isFull == true
 *
 * @post isFull == false
 *
 */
public function empty();

}
