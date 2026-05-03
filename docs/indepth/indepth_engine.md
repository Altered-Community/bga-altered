# Engine

The flow engine works with a tree of nodes, each one representing a step/action or a group of nodes/steps/actions that need to be done.

## Node

All types of nodes inherit from the [`AbstractNode`](../../modules/php/Core/Engine/AbstractNode.php) encapsulating all basic usage.

### A node contains
- **childs** (array): Can contain other node(s).
- **infos** (array): Contains all the possible info needed like type, arguments, cardId, optional, action, etc...

### A node has those states
- **Doable** (bool): can the node be executed? conditions depend on the type of node
- **Resolved** (bool): is the node already resolved? conditions depend on the type of node
- **optional** (bool): is the node optional or not

### types of node
- [**Leaf**](../../modules/php/Core/Engine/LeafNode.php): The most basic type of nodes. It doesn't have behaviors linked to children; all its behaviors are linked to its action.
- [**Or**](../../modules/php/Core/Engine/OrNode.php): Is doable if one of its children is doable. Require choices to be made. Resolve when all choices have been made and/or all children are resolved.
- [**Parallel**](../../modules/php/Core/Engine/ParallelNode.php): 
- [**Seq**](../../modules/php/Core/Engine/SeqNode.php): Represent a sequence of actions, doable if all children are doable. Resolved when all children are resolved.
- [**Xor**](../../modules/php/Core/Engine/XorNode.php): Same as Or node but with a unique possibility to choose. It gets resolved as soon as one child gets resolved.

## How it works

The base node is always a Sequence one, to make sure everything is resolved before ending the process.

The flow tree is saved in database.

## Navigation
[< Back to main](../README.md)