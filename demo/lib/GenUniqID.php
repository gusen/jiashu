<?php
function GenUniqID()
{
  $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  $random = $chars[mt_rand(0,61)].$chars[mt_rand(0,61)];
  return uniqid().$random;
}
?>
