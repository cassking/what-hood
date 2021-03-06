<?php
namespace Application\PHPUnit;

use Application\Spatial\PHP\Types\Geometry\LineString;
use Application\Spatial\PHP\Types\Geometry\Point;
use Application\Spatial\PHP\Types\Geometry\Polygon;
use Application\Entity\Neighborhood;
use Application\Entity\NeighborhoodVote;
use Application\Entity\Region;
use Application\Entity\HeatMap;
use Application\Entity\WhathoodUser;
use Application\Entity\FacebookUser;
use Application\Entity\NeighborhoodPolygon;
use Application\Entity\NeighborhoodPolygonVote;
use Application\Model\HeatMap\Point as HeatMapPoint;
/**
 * Description of DummyEntityBuilder
 *
 * @author Jim Smiley twitter:@jimRsmiley
 */
class DummyEntityBuilder {
    
    public static function heatMap() {
        return new HeatMap( array(
            'points' => array( 
                    new HeatMapPoint( '0', '1', $value = 25 )
                ),
            'neighborhood' => self::neighborhood(),
            'region' => self::region()
        ));
    }
    
    /*
     * return a filler polygon, useful for when not testing polygon stuff
     */
    public static function polygon() {
        
        $lineString = new LineString(array( 
                        new Point(0,0),
                        new Point(10,0),
                        new Point(10,10),
                        new Point(0,10),
                    ));
        $lineString->close();
        
        return new Polygon( $rings = array( $lineString ) );
    }
    
    public static function neighborhoodPolygon($whathoodUser) {
        
        if( empty( $whathoodUser ) )
            throw new \InvalidArgumentException('must supply an already saved whathoodUser');
        
        $n = new NeighborhoodPolygon( array(
            'neighborhood'  => self::neighborhood(),
            'region'        => self::region(),
            'polygon'       => self::polygon(),
            'whathoodUser'  => $whathoodUser
        ));
        return $n;
    }
    
    public static function neighborhood() {
                return new Neighborhood( array(
                'name'          => 'Mayfair',
                'dateTimeAdded' => '2013-01-01 12:30:00',
                'polygon'       => self::polygon(),
                'region'        => self::region(),
                'whathoodUser'  => self::whathoodUser()
                ));
    }
    
    public static function neighborhoodPolygonVote() {
        return new NeighborhoodPolygonVote( array(
            'dateTimeAdded' => '2013-01-01 12:30:00',
            'whathoodUser'  => self::whathoodUser(),
            'vote'          => -1
        ));
    }
    
    public static function region() {
        return new Region( array(
            'name' => 'Philadelphia',
            'centerPoint' => new Point(0,1)
        ));
    }
    
    public static function whathoodUser() {
        return new WhathoodUser( array(
            'userName'  => 'test_ whathood user name',
        ));
    }
    
    public static function facebookUser() {
        return new FacebookUser( array(
            'id'    => '123',
            'name'  => 'Joe Schmoe',
            'firstName' => 'Joe',
            'lastName' => 'Schmoe',
            'link'  => 'http://facebook.com/joe.schmoe',
            'username'  => 'joe123',
            'gender' => 'male',
            'timezone' => 'eastern',
            'locale'    => 'US',
            'verified'  => 'sure',
            'updatedTime' => '2013-01-01 12:34:45'
        ));
    }
}

?>
