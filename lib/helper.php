<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

function followistic_widget()
{
  echo FollowisticWidget::get_script();
}

function followistic_admin_page_url()
{
  return admin_url('admin.php?page=followistic_admin');
}

function followistic_messages()
{
  return FollowisticFrontend::get_messages();
}

function followistic_has_api_key()
{
  return Followistic::getInstance()->has_api_key();
}

function followistic_api_key()
{
  return Followistic::getInstance()->get_api_key();
}

function followistic_widget_placement_options()
{
  return Followistic::getInstance()->get_widget_placement_options();
}

function followistic_widget_placement()
{
  return Followistic::getInstance()->get_widget_placement();
}

function followistic_widget_has_margins()
{
  return Followistic::getInstance()->has_margins();
}

function followistic_widget_margin_options()
{
  return Followistic::getInstance()->get_widget_margin_options();
}

function followistic_widget_margins()
{
  return Followistic::getInstance()->get_widget_margins();
}