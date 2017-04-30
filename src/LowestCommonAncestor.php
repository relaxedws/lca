<?php

namespace Relaxed\LCA;

use Fhaculty\Graph\Vertex;
use Graphp\Algorithms\Search\BreadthFirst;
use Relaxed\LCA\LcaException;

class LowestCommonAncestor
{
    /**
     * The function finds out the lowest common ancestor(LCA) of two nodes.
     *              1
     *            /  \
     *           2    5
     *         /  \    \
     *        3    4    6
     *  For example: LCA of (3,4) would be 2
     *  LCA of (3,6) would be 1.
     * @param Vertex $local
     * @param Vertex $remote
     * @return Lowest common ancestor from the graph.
     */
    public function find(Vertex $local, Vertex $remote)
    {
        // Traverse in reverse order starting from $local to the root.
        $direction = BreadthFirst::DIRECTION_REVERSE;
        // Use BFS algorithm to get all vertices starting with $local to the root.
        $bfs_local = new BreadthFirst($local);
        $vertices_local = $bfs_local->setDirection($direction)->getVertices();
        // Use BFS algorithm to get all vertices starting with $remote to the root.
        $bfs_remote = new BreadthFirst($remote);
        $vertices_remote = $bfs_remote->setDirection($direction)->getVertices();
        // Intersect the $vertices_local and $vertices_remote to get all common
        // ancestors for $local and $remote. If the $vertices_intersection array is
        // not empty then first value should be our solution - the LCA.
        $vertices_intersection = $vertices_local
            ->getVerticesIntersection($vertices_remote)
            ->getMap();
        if ($lca = reset($vertices_intersection)) {
            return  $lca;
        } else {
            throw new LcaException("No common ancestor found");
        }
    }
}
