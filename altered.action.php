<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Altered implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on https://boardgamearena.com.
 * See http://en.doc.boardgamearena.com/Studio for more information.
 * -----
 *
 * altered.action.php
 *
 * Altered main action entry point
 *
 *
 * In this file, you are describing all the methods that can be called from your
 * user interface logic (javascript).
 *
 * If you define a method "myAction" here, then you can call it from your javascript code with:
 * this.ajaxcall( "/altered/altered/myAction.html", ...)
 *
 */

class action_altered extends APP_GameAction
{
  // Constructor: please do not modify
  public function __default()
  {
    if (self::isArg('notifwindow')) {
      $this->view = 'common_notifwindow';
      $this->viewArgs['table'] = self::getArg('table', AT_posint, true);
    } else {
      $this->view = 'altered_altered';
      self::trace('Complete reinitialization of board game');
    }
  }

  public function actDisplayAllCards()
  {
    self::setAjaxMode();
    $result = $this->game->actDisplayAllCards();
    self::ajaxResponseWithResult($result);
  }

  public function loadBugSQL()
  {
    self::setAjaxMode();
    $reportId = (int) self::getArg('report_id', AT_int, true);
    $this->game->loadBugSQL($reportId);
    self::ajaxResponse();
  }

  public function actChangePref()
  {
    self::setAjaxMode();
    $pref = self::getArg('pref', AT_posint, false);
    $value = self::getArg('value', AT_posint, false);
    $this->game->actChangePreference($pref, $value);
    self::ajaxResponse();
  }

  public function actSelectPrecoDeck()
  {
    self::setAjaxMode();
    $choice = self::getArg('choice', AT_int, true);
    $this->game->actSelectPrecoDeck($choice);
    self::ajaxResponse();
  }

  public function actCancelPrecoDeckSelection()
  {
    self::setAjaxMode();
    $this->game->actCancelPrecoDeckSelection();
    self::ajaxResponse();
  }

  public function actFirstDayManaSelection()
  {
    self::setAjaxMode();
    $cardIds = self::getArg('cardIds', AT_json, true);
    $this->validateJSonAlphaNum($cardIds, 'cardIds');
    $this->game->actFirstDayManaSelection($cardIds);
    self::ajaxResponse();
  }

  public function actCancelFirstDayManaSelection()
  {
    self::setAjaxMode();
    $this->game->actCancelFirstDayManaSelection();
    self::ajaxResponse();
  }

  public function actNewDayManaSelection()
  {
    self::setAjaxMode();
    $cardIds = self::getArg('cardIds', AT_json, true);
    $this->validateJSonAlphaNum($cardIds, 'cardIds');
    $this->game->actNewDayManaSelection($cardIds);
    self::ajaxResponse();
  }

  public function actPassNewDayManaSelection()
  {
    self::setAjaxMode();
    $this->game->actPassNewDayManaSelection();
    self::ajaxResponse();
  }

  public function actGetDeck()
  {
    self::setAjaxMode();
    $args = self::getArg('deckNumber', AT_int, true);

    $result = $this->game->actGetDeck($deckNumber);
    self::ajaxResponseWithResult($result);
  }

  //////////////////
  ///// ENGINE  /////
  //////////////////

  public function actConfirmTurn()
  {
    self::setAjaxMode();
    $this->game->actConfirmTurn();
    self::ajaxResponse();
  }

  public function actConfirmPartialTurn()
  {
    self::setAjaxMode();
    $this->game->actConfirmPartialTurn();
    self::ajaxResponse();
  }

  public function actRestart()
  {
    self::setAjaxMode();
    $this->game->actRestart();
    self::ajaxResponse();
  }

  public function actUndoToStep()
  {
    self::setAjaxMode();
    $stepId = self::getArg('stepId', AT_posint, false);
    $this->game->actUndoToStep($stepId);
    self::ajaxResponse();
  }

  public function actTakeAtomicAction()
  {
    self::setAjaxMode();
    $action = self::getArg('actionName', AT_alphanum, true);
    $args = self::getArg('actionArgs', AT_json, true);
    $this->validateJSonAlphaNum($args, 'actionArgs');
    $this->game->actTakeAtomicAction($action, $args);
    self::ajaxResponse();
  }

  public function actChooseAction()
  {
    self::setAjaxMode();
    $choiceId = self::getArg('id', AT_int, true);
    $result = $this->game->actChooseAction($choiceId);
    self::ajaxResponse();
  }

  public function actPassOptionalAction()
  {
    self::setAjaxMode();
    $result = $this->game->actPassOptionalAction();
    self::ajaxResponse();
  }

  public function actAnytimeAction()
  {
    self::setAjaxMode();
    $choiceId = self::getArg('id', AT_int, true);
    $result = $this->game->actAnytimeAction($choiceId);
    self::ajaxResponse();
  }

  //////////////////
  ///// UTILS  /////
  //////////////////
  public function validateJSonAlphaNum($value, $argName = 'unknown')
  {
    if (is_array($value)) {
      foreach ($value as $key => $v) {
        $this->validateJSonAlphaNum($key, $argName);
        $this->validateJSonAlphaNum($v, $argName);
      }
      return true;
    }
    if (is_int($value)) {
      return true;
    }
    $bValid = preg_match('/^[_0-9a-zA-Z- ]*$/', $value) === 1;
    if (!$bValid) {
      throw new feException("Bad value for: $argName", true, true, FEX_bad_input_argument);
    }
    return true;
  }
}
