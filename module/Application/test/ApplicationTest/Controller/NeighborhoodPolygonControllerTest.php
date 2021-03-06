<?php

namespace ApplicationTest\Controller;

use Zend\Http\Request;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Stdlib\Parameters;
use Application\PHPUnit\BaseControllerTest;
/**
 * Description of NeighborhoodControllerTest
 *
 * @author Jim Smiley twitter:@jimRsmiley
 */
class NeighborhoodPolygonControllerTest extends BaseControllerTest {

    public function setUp() {
        parent::setUp();
        $this->initDb();
    } 
    
    public function testByIdJson() {
        
        $whathoodUser = $this->getSavedAuthenticatedWhathoodUser();
        $neighborhoodPolygon = \Application\PHPUnit\DummyEntityBuilder::neighborhoodPolygon($whathoodUser);
        $this->neighborhoodPolygonMapper()->save( $neighborhoodPolygon );
        
        $this->getRequest()
                ->setMethod('GET');
        
        $this->dispatch( '/n/id/1?format=json' );

        $this->assertResponseStatusCode(200);
        
        $json = $this->getResponse()->getBody();
        
        try {
            $array = \Zend\Json\Json::decode( $json );
            $this->assertTrue(true);
        } catch( \Exception $ex ) {
            $this->assertTrue(false, 'json did not decode correctly' );
        }
    }
    
    /**
     * @group add-neighborhood
     */
    public function testAddNeighborhoodAction() {
        $this->initDb();
        $whathoodUser = $this->getSavedAuthenticatedWhathoodUser();
        $neighborhoodPolygon = \Application\PHPUnit\DummyEntityBuilder::neighborhoodPolygon($whathoodUser);
        $this->neighborhoodPolygonMapper()->save( $neighborhoodPolygon );
        

        $this->getRequest()->setMethod('GET');
        // don't know why i have to set this
        $_SERVER['REQUEST_URI'] = '/n/add';

        $this->dispatch( '/n/add' );
        $this->assertResponseStatusCode(200);
        
        $uri = '/n/add?region=Philadelphia';
        $_SERVER['REQUEST_URI'] = $uri;
        $this->dispatch($uri);
        $this->assertResponseStatusCode(200);
        
        $this->getRequest()  
            ->setMethod('POST')
            ->setPost(
                new Parameters( array(
                    'neighborhoodPolygon' => array(
                        'neighborhood' => array(
                            'name' => 'Test Neighborhood'
                        ),
                        'region'    => array(
                            'name' => 'Philadelphia'
                        ),
                    ),
                    'polygonGeoJson' => '{"type":"Feature","geometry":{"id":2,"neighborhood":{"id":2,"name":"Bustleton","region":{"id":1,"name":"Philadelphia","center_point":{},"neighborhood_polygons":{}},"date_time_added":"2013-08-16 21:30:52","neighbhorhood_polygons":{}},"region":{},"whathood_user":{},"date_time_added":{"date":"2013-08-16 21:30:52","timezone_type":3,"timezone":"America\/New_York"},"authrotiy":true,"deleted":false,"neighborhood_votes":null,"type":"Polygon","coordinates":[[[40.094871100209,-75.015599208924],[40.092756115184,-75.017684142696],[40.089131396676,-75.021120774685],[40.088315359697,-75.021893591517],[40.088174494227,-75.022072443413],[40.087500435318,-75.022713576016],[40.086165136063,-75.02402677331],[40.085430289183,-75.024654567287],[40.08482191622,-75.025261521804],[40.08361356085,-75.026543071135],[40.082364789786,-75.027720495584],[40.081003448884,-75.028977266379],[40.079068686038,-75.030834609506],[40.07850725553,-75.031434741861],[40.076799075061,-75.032986261033],[40.076777693702,-75.033096394226],[40.074618175211,-75.035087383274],[40.073333892129,-75.03630956027],[40.073089290201,-75.036615939203],[40.071270900711,-75.038327705485],[40.069851547677,-75.039585848422],[40.06875453433,-75.040333981463],[40.068740529251,-75.040343531597],[40.068631929605,-75.040370673826],[40.068944546664,-75.040909530245],[40.06929104737,-75.041362247108],[40.069705319126,-75.041642678867],[40.070280336241,-75.041769292412],[40.071104691969,-75.0412705252],[40.072228972297,-75.039958256435],[40.07267367863,-75.039897982711],[40.073646962013,-75.040583588527],[40.077054566235,-75.042963463792],[40.077482821817,-75.043692575706],[40.077849675618,-75.043728316938],[40.082913508179,-75.047443934561],[40.080271160786,-75.050925581441],[40.080623113576,-75.051534338044],[40.079583210252,-75.052572322045],[40.080980895128,-75.054931074861],[40.086780540111,-75.057032245241],[40.087065207604,-75.056673911118],[40.087428640675,-75.056455111731],[40.087819316601,-75.05632844015],[40.088325171654,-75.056274229462],[40.088780405943,-75.05640814437],[40.089108771992,-75.056609728619],[40.089751073066,-75.057075065308],[40.090020091049,-75.057741769405],[40.090183548548,-75.058294568265],[40.090541864729,-75.063184689857],[40.09059767035,-75.06372228012],[40.090677310725,-75.064097378899],[40.090876714613,-75.064465350092],[40.092469595519,-75.066132744765],[40.092674342995,-75.065969101275],[40.094637111787,-75.068496909811],[40.094482165032,-75.069387192829],[40.096224000304,-75.067702999798],[40.096771999969,-75.067173999949],[40.098353999781,-75.065651000201],[40.099092000305,-75.064932999612],[40.099584000283,-75.064456999733],[40.099845999953,-75.064202999859],[40.100320999706,-75.063745000003],[40.100466000149,-75.0636030002],[40.100533000066,-75.063537000534],[40.101300000388,-75.062795999556],[40.101366999775,-75.062732000018],[40.102741000389,-75.061400999808],[40.10385900027,-75.060318000168],[40.104655999667,-75.059540000094],[40.105010999614,-75.059195999955],[40.10589200007,-75.058342000337],[40.106163000303,-75.057952999997],[40.106376999779,-75.057518000411],[40.106631999681,-75.057067000487],[40.106693999804,-75.057178000187],[40.107990000243,-75.055327999658],[40.10869199967,-75.054321000364],[40.109635999659,-75.052975000305],[40.109668999786,-75.052925000113],[40.110220999598,-75.052133999447],[40.110725617889,-75.051411587576],[40.111251999966,-75.050658000026],[40.112041999778,-75.049525999808],[40.112135000351,-75.049391999981],[40.112198999615,-75.049300000426],[40.112690657406,-75.048596836672],[40.112672393675,-75.048561801754],[40.112250344388,-75.047768961267],[40.108401432803,-75.041171098359],[40.107113112093,-75.038843425719],[40.106964120986,-75.037143359634],[40.106747540955,-75.035587124899],[40.106272592611,-75.034721987723],[40.105723266032,-75.033874828456],[40.105153859431,-75.032908603094],[40.103288623242,-75.029941398545],[40.102560090175,-75.028816794144],[40.101841269009,-75.02761689664],[40.101588584718,-75.026907778504],[40.10111619982,-75.02566804479],[40.100738747731,-75.024064882844],[40.100411601982,-75.02280198343],[40.100099193213,-75.021842936098],[40.098299208341,-75.01969773638],[40.097646306136,-75.018854965156],[40.097074858177,-75.018265893001],[40.094871100209,-75.015599208924]]],"user":{"facebook_user":null,"user_name":"Azavea","id":1,"votes":{},"is_authority":true}},"properties":null}'
                ))
            );
      
        $this->dispatch('/n/add?region_name=Philadelphia');
        
        print "testAddNeighborhoodAction: about to print response";
        $this->printResponse();
       // exit;
        $this->assertResponseStatusCode(200);
        $this->assertNotControllerName('error');
        
        $neighborhoodPolygon = $this->neighborhoodPolygonMapper()->byId(1);
        $this->assertEquals('Test Neighborhood', 
                        $neighborhoodPolygon->getNeighborhood()->getName() );
    }
}
?>