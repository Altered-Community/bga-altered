# How to start

## Install

First of all, install the project. You can see the doc on how to do it here: [Install documentation] (install.md)

## BGA starting Resources
- https://en.doc.boardgamearena.com/First_steps_with_BGA_Studio
- https://en.doc.boardgamearena.com/Setting_up_BGA_Development_environment_using_VSCode
- https://en.doc.boardgamearena.com/Tools_and_tips_of_BGA_Studio

## Debug Options

> Optional debug features in `DebugTrait.php`.

### Available Commands

- **`addCard`** – Add a card by its ID (e.g., `BR_Common_Kedarm`) to a location.  
  Locations: `hand` (default), `reserve`, `mana`, `landmark`, `stormLeft`, `stormRight`, `limbo`, etc.

- **`loadUnique`** – TBD

- **`deck`** → TBD

### Custom Setup

For complex scenarios (e.g., bug #210538: 2× Fab Lab Unit, 1× Reka Fisherman rare, Kedarm in reserve, Foundry in landmarks), use `debug_setup()`.

#### How to use:

1. Find `function debug_setup()` in `DebugTrait.php`
2. Uncomment it
3. Configure your cards and locations set up
4. Reload the page – a button will appear

> Samples provided in the code. Push commented by default – uncomment only when needed.

## Navigation
[< Back to main](../README.md)
