<?php

if (!isset($_SESSION)) {
  session_start();
}

/**
 * ログインしているかどうかをチェックする
 *
 * @return bool
 */
function isLogin()
{
  if (isset($_SESSION['user'])) {
    return true;
  }

  return false;
}

/**
 * ログインしているユーザーの表示用ユーザー名を取得
 *
 * @return mixed|string
 */
function getLoginUserName()
{
  if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['name'];

    if (7 < mb_strlen($name)) {
      $name = mb_substr($name, 0, 7) . "...";
    }

    return $name;
  }

  return "";
}

/**
 * ログインしているユーザーIDを取得
 *
 * @return mixed|null
 */
function getLoginUserId()
{
  if (isset($_SESSION['user'])) {
    return $_SESSION['user']['id'];
  }

  return null;
}