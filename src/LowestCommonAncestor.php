<?php

namespace Relaxed\LCA;

use Fhaculty\Graph\Vertex;
use Fhaculty\Graph\Graph;
use Graphp\Algorithms\Search\BreadthFirst;

class LowestCommonAncestor {

  function __construct(Graph $graph) {
    $this->graph = $graph;
  }

  function find(Vertex $local, Vertex $remote) {
    // Traverse in reverse order the graph when searching;
    $direction = BreadthFirst::DIRECTION_REVERSE;
    // Use BFS algorithm to get all vertices starting with $local to the root.
    $bfs_local = new BreadthFirst($local);
    $vertices_local = $bfs_local->setDirection($direction)->getVertices()->getMap();
    // Use BFS algorithm to get all vertices starting with $remote to the root.
    $bfs_remote = new BreadthFirst($remote);
    $vertices_remote = $bfs_remote->setDirection($direction)->getVertices()->getMap();
    // Intersect the $vertices_local and $vertices_remote to get all common
    // ancestors for $local and $remote.
    $vertices_intersection = array_intersect(array_keys($vertices_local), array_keys($vertices_remote));
    // If the $vertices_intersection array is not empty then first value should
    // be our solution - the LCA.
    $lca_id = reset($vertices_intersection);
    if ($lca_id !== NULL && $lca = $this->graph->getVertex($lca_id)) {
      return $lca;
    }
    return FALSE;
  }

}
