# Relaxedws/lca [![Build Status](https://travis-ci.org/relaxedws/lca.svg?branch=master)](https://travis-ci.org/relaxedws/lca)

A PHP Library to find Lowest Common ancestor from a Directed Acyclic Graph.

## Insight

This library is built to find the Lowest Common ancestor from a Directed Acyclic graph. It first creates a graph and then stores the parents of
a node(let's call it node1) in an array(call it array1). To find the parents of node1, we use [Breadth First Search](https://en.wikipedia.org/wiki/Breadth-first_search) traversal in reverse order,
i.e, From node1 to root. Same is done with node2. Then we find the LCA by the intersection of elements from array1 and array2. The first node returned
by the intersection is the LCA of the 2 nodes.

## Dependencies

This library uses [clue/graph](https://github.com/clue/graph) for creation of the graph and [graphp/algorithms](https://github.com/graphp/algorithms)
for Breadth First Traversal.

## Install

The library can be installed via [composer](http://getcomposer.org).

````JSON
{
  "name": "myorg/mylib",
  "description": "A library depending on relaxed/lca",
  "require": {
    "relaxedws/lca": "dev-master"
  }
}
````

## Example

After [installation](#install), we can perform a merge the following way:

````php
<?php

require __DIR__ ."/vendor/autoload.php";

use Fhaculty\Graph\Graph;
use Relaxed\LCA\LowestCommonAncestor;

$graph = new Graph();

for ($i=1; $i<=6 ; $i++){
   $vertices['node_'.$i] = $graph->createVertex('node_'.$i);
}

$vertices['node_1']->createEdgeTo($vertices['node_2']);
$vertices['node_1']->createEdgeTo($vertices['node_5']);
$vertices['node_2']->createEdgeTo($vertices['node_3']);
$vertices['node_2']->createEdgeTo($vertices['node_4']);
$vertices['node_5']->createEdgeTo($vertices['node_6']);


$instance = new LowestCommonAncestor($graph);

$lca = $instance->find($vertices['node_3'], $vertices['node_4']);
$base = $lca->getId();
````

## Contributing

We welcome anyone to use, test, or contribute back to this project.
We have extensive test coverage, but as we all know there's always bugs in software.
Please file issues or pull requests with your comments or suggestions.
