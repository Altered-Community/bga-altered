# Project structure

The entry point of the project is `altered.game.php`.

## Root folder
Here we'll go over some files that are important and whose purpose may not be obvious.

- `altered_altered.tpl`:  Base HTML structure of the game main layout.
- `altered.action.php`: Here are all the methods we can call from our JavaScript (user interface)
- ➡️ `altered.game.php`: Main file of the game, it set up the game, implement all States, set up the turn order etc..
- `gameoptions.json`: JSon file to set up the options for the game in here we can have game mode and all the setup to be queued with people with the same setup ([BGA Docs](https://en.doc.boardgamearena.com/Options_and_preferences:_gameoptions.json,_gamepreferences.json)). It's here that you'll find:
    - deck formats (NUC, Sandbox, Frontier)
    - game modes (Beginner or Standard)
    - allow undo
- `gamepreferences.json`: here are all the preferences that can change the way the game/table is played ([BGA Docs](https://en.doc.boardgamearena.com/Options_and_preferences:_gameoptions.json,_gamepreferences.json)) like (non-exhaustive list):
    - Turn confirmation
    - undo
    - actions confirmations
- `states.inc.php`: Describe all the states of the game like, first day, new day, pre-dusk, dusk, all turn states/steps. BGA Games works with these states so it's an important one. It links those states to functions like
    - args function to get some info
    - action function
    - Etc...

**The bulk of the logic is in the `modules/php` folder** 

## Flow Engine

It's a big piece and a very important one [Flow Engine Documentations](indepth/indepth_engine.md).

[< Back to main](../README.md)