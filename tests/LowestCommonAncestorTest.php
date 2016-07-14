<?php

namespace Relaxed\LCA\Test;

use Fhaculty\Graph\Graph;
use Relaxed\LCA\LcaException;
use Relaxed\LCA\LowestCommonAncestor;

class LowestCommonAncestorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Graphical representation for the Basic Graph is in pictures folder.
     */
    public function testBasicGraph()
    {
        $graph = new Graph();
        //Creating new Graph with 21 nodes.
        $vertices = $this->generateVertices($graph, 21);
        //Creating edges starting from root(node_1) to node_21
        $vertices['node_1']->createEdgeTo($vertices['node_2']);
        $vertices['node_1']->createEdgeTo($vertices['node_3']);
        $vertices['node_3']->createEdgeTo($vertices['node_8']);
        $vertices['node_2']->createEdgeTo($vertices['node_4']);
        $vertices['node_4']->createEdgeTo($vertices['node_5']);
        //Loop over the same node.
        $vertices['node_5']->createEdgeTo($vertices['node_5']);
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
        $test_node5 = $lca->find($vertices['node_5'], $vertices['node_13']);
        $this->assertEquals('node_4', $test_node5->getId());
        $test_node6 = $lca->find($vertices['node_5'], $vertices['node_5']);
        $this->assertEquals('node_5', $test_node6->getId());
    }

    /**
     * Graphical representation for the Complex Graph is in pictures folder.
     */
    public function testbitComplexGraph()
    {
        $graph = new Graph();
        //Creating new Graph with 8 nodes.
        $vertices = $this->generateVertices($graph, 8);
        //Creating edges starting from root(node_1) to node_8
        $vertices['node_1']->createEdgeTo($vertices['node_2']);
        $vertices['node_2']->createEdgeTo($vertices['node_3']);
        $vertices['node_2']->createEdgeTo($vertices['node_5']);
        $vertices['node_2']->createEdgeTo($vertices['node_4']);
        $vertices['node_3']->createEdgeTo($vertices['node_7']);
        $vertices['node_3']->createEdgeTo($vertices['node_6']);
        $vertices['node_4']->createEdgeTo($vertices['node_6']);
        $vertices['node_5']->createEdgeTo($vertices['node_8']);
        $vertices['node_6']->createEdgeTo($vertices['node_8']);

        $lca = new LowestCommonAncestor($graph);

        $test_node1 = $lca->find($vertices['node_2'], $vertices['node_3']);
        $this->assertEquals('node_2', $test_node1->getId());
        $test_node2 = $lca->find($vertices['node_3'], $vertices['node_4']);
        $this->assertEquals('node_2', $test_node2->getId());
        $test_node3 = $lca->find($vertices['node_6'], $vertices['node_4']);
        $this->assertEquals('node_4', $test_node3->getId());
        $test_node4 = $lca->find($vertices['node_6'], $vertices['node_7']);
        $this->assertEquals('node_3', $test_node4->getId());
        $test_node5 = $lca->find($vertices['node_6'], $vertices['node_5']);
        $this->assertEquals('node_2', $test_node5->getId());
    }

    /**
     * Graphical representation for the Most Complex Graph is in pictures folder.
     */
    public function testmostComplexGraph()
    {
        $graph = new Graph();
        //Creating new Graph with 9 nodes.
        $vertices = $this->generateVertices($graph, 10);
        //Creating edges starting from root(node_1) to node_10.
        $vertices['node_1']->createEdgeTo($vertices['node_2']);
        $vertices['node_1']->createEdgeTo($vertices['node_3']);
        $vertices['node_1']->createEdgeTo($vertices['node_4']);
        $vertices['node_2']->createEdgeTo($vertices['node_5']);
        $vertices['node_2']->createEdgeTo($vertices['node_7']);
        $vertices['node_3']->createEdgeTo($vertices['node_6']);
        $vertices['node_3']->createEdgeTo($vertices['node_7']);
        $vertices['node_3']->createEdgeTo($vertices['node_5']);
        $vertices['node_4']->createEdgeTo($vertices['node_6']);
        $vertices['node_4']->createEdgeTo($vertices['node_8']);
        $vertices['node_5']->createEdgeTo($vertices['node_7']);
        $vertices['node_5']->createEdgeTo($vertices['node_8']);
        $vertices['node_6']->createEdgeTo($vertices['node_7']);
        $vertices['node_6']->createEdgeTo($vertices['node_8']);

        //Node 10 doesn't have any parent or child.

        $lca = new LowestCommonAncestor($graph);

        $test_node1 = $lca->find($vertices['node_5'], $vertices['node_7']);
        $this->assertEquals('node_5', $test_node1->getId());
        $test_node2 = $lca->find($vertices['node_7'], $vertices['node_8']);
        $this->assertEquals('node_2', $test_node2->getId());
        //Same node passed as remote and local
        $test_node3 = $lca->find($vertices['node_7'], $vertices['node_7']);
        $this->assertEquals('node_7', $test_node3->getId());
        $test_node4 = $lca->find($vertices['node_2'], $vertices['node_8']);
        $this->assertEquals('node_2', $test_node4->getId());
        $test_node5 = $lca->find($vertices['node_8'], $vertices['node_2']);
        $this->assertEquals('node_1', $test_node5->getId());
        //For the node with no parent: No common parents found.
        try {
            $lca->find($vertices['node_8'], $vertices['node_10']);
            $this->fail('Exception was not thrown.');
        } catch (LcaException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @param Graph $graph
     * @param int $count
     * @return \Fhaculty\Graph\Vertex[]
     */
    public function generateVertices(Graph $graph, $count = 5)
    {
        for ($i = 1; $i <= $count; $i++) {
            $ids[] = "node_$i";
        }
        return $graph->createVertices($ids)->getMap();
    }
}
