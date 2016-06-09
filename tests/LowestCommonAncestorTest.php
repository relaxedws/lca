<?php

namespace Relaxed\LCA\Test;

use Fhaculty\Graph\Graph;
use Relaxed\LCA\LowestCommonAncestor;

class LowestCommonAncestorTest extends \PHPUnit_Framework_TestCase
{
    public function testLca()
    {
        $graph = new Graph();
        //Creating new Graph with 21 nodes.
        $vertices = $this->generateVertices($graph,21);
        //Creating edges starting from root(node_1) to node_21
        $vertices['node_1']->createEdgeTo($vertices['node_2']);
        $vertices['node_1']->createEdgeTo($vertices['node_3']);
        $vertices['node_3']->createEdgeTo($vertices['node_8']);
        $vertices['node_2']->createEdgeTo($vertices['node_4']);
        $vertices['node_4']->createEdgeTo($vertices['node_5']);
        $vertices['node_4']->createEdgeTo($vertices['node_6']);
        $vertices['node_4']->createEdgeTo($vertices['node_7']);
        $vertices['node_5']->createEdgeTo($vertices['node_11']);
        $vertices['node_5']->createEdgeTo($vertices['node_12']);
        $vertices['node_6']->createEdgeTo($vertices['node_13']);
        $vertices['node_7']->createEdgeTo($vertices['node_16']);
        $vertices['node_8']->createEdgeTo($vertices['node_9']);
        $vertices['node_8']->createEdgeTo($vertices['node_10']);
        $vertices['node_9']->createEdgeTo($vertices['node_17']);
        $vertices['node_10']->createEdgeTo($vertices['node_18']);
        $vertices['node_12']->createEdgeTo($vertices['node_14']);
        $vertices['node_12']->createEdgeTo($vertices['node_15']);
        $vertices['node_17']->createEdgeTo($vertices['node_19']);
        $vertices['node_17']->createEdgeTo($vertices['node_20']);
        $vertices['node_18']->createEdgeTo($vertices['node_21']);

        $lca = new LowestCommonAncestor($graph);

        //Test cases for different pair of nodes.   
        $test_node1 = $lca->find($vertices['node_14'], $vertices['node_15']);
        $this->assertEquals('node_12', $test_node1->getId());
        $test_node2 = $lca->find($vertices['node_11'], $vertices['node_15']);
        $this->assertEquals('node_5', $test_node2->getId());
        $test_node3 = $lca->find($vertices['node_16'], $vertices['node_17']);
        $this->assertEquals('node_1', $test_node3->getId());
        $test_node4 = $lca->find($vertices['node_9'], $vertices['node_17']);
        $this->assertEquals('node_9', $test_node4->getId());
        $test_node5 = $lca->find($vertices['node_20'], $vertices['node_19']);
        $this->assertEquals('node_17', $test_node5->getId());
    }

    /**
     * Function to create multiple vertices.
     * @param Graph $graph
     * @param int $count
     * @return \Fhaculty\Graph\Vertex[]
     */
    public function generateVertices(Graph $graph, $count = 5)
    {
        for ($i = 1; $i <= $count; $i++)
        {
            $ids[] = "node_$i";
        }
        return $graph->createVertices($ids)->getMap();
    }
}
