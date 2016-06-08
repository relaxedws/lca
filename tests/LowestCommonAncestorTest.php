<?php

namespace Relaxed\LCA\Test;

use Fhaculty\Graph\Graph;
use Relaxed\LCA\LowestCommonAncestor;
use Fhaculty\Graph\Vertex;
use Graphp\Algorithms\Search\BreadthFirst;

class LowestCommonAncestorTest extends \PHPUnit_Framework_TestCase
{
    public $ancestor;
    public $graph;
    public function testlca()
    {
        $graph = new Graph();

        $one = $graph->createVertex('One');
        $two = $graph->createVertex('Two');
        $three = $graph->createVertex('Three');
        $four = $graph->createVertex('Four');
        $five =$graph->createVertex('Five');
        $six = $graph->createVertex('Six');
        $seven = $graph->createVertex('Seven');
        $eight = $graph->createVertex('Eight');
        $nine = $graph->createVertex('Nine');
        $ten = $graph->createVertex('Ten');
        $eleven = $graph->createVertex('Eleven');
        $twelve = $graph->createVertex('Twelve');
        $thirteen =$graph->createVertex('Thirteen');
        $fourteen = $graph->createVertex('Fourteen');
        $fifteen = $graph->createVertex('Fifteen');
        $sixteen = $graph->createVertex('Sixteen');
        $seventeen= $graph->createVertex('Seventeen');
        $eighteen = $graph->createVertex('Eighteen');
        $nineteen = $graph->createVertex('Nineteen');
        $twenty = $graph->createVertex('Twenty');
        $twenty_one = $graph->createVertex('Twenty One');

        $one->createEdgeTo($three);
        $one->createEdgeTo($two);
        $two->createEdgeTo($four);
        $three->createEdgeTo($eight);
        $four->createEdgeTo($five);
        $four->createEdgeTo($six);
        $four->createEdgeTo($seven);
        $eight->createEdgeTo($nine);
        $eight->createEdgeTo($ten);
        $five->createEdgeTo($eleven);
        $five->createEdgeTo($twelve);
        $twelve->createEdgeTo($fourteen);
        $twelve->createEdgeTo($fifteen);
        $six->createEdgeTo($thirteen);
        $seven->createEdgeTo($sixteen);
        $nine->createEdgeTo($seventeen);
        $seventeen->createEdgeTo($twenty);
        $seventeen->createEdgeTo($nineteen);
        $ten->createEdgeTo($eighteen);
        $eighteen->createEdgeTo($twenty_one);

        $lca = new LowestCommonAncestor($graph);
        $ancestor = $lca->find($thirteen, $fourteen);
        $result = $ancestor->getId();
        // Returns the result
        $this->assertEquals('Four', $result);
    }
}