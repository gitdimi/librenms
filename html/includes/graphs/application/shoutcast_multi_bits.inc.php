<?php

$device = device_by_id_cache($vars['id']);

$units       = 'b';
$total_units = 'B';
$colours_in  = 'greens';
$multiplier  = '8';
$colours_out = 'blues';

$nototal = 1;

$ds_in  = 'traf_in';
$ds_out = 'traf_out';

$graph_title = 'Traffic Statistic';

$colour_line_in  = '006600';
$colour_line_out = '000099';
$colour_area_in  = 'CDEB8B';
$colour_area_out = 'C3D9FF';

$rrd_list = array();
$rrd_filenames = glob(rrd_name($device['hostname'], array('app', 'shoutcast', $app['app_id'], '*')));
foreach ($rrd_filenames as $file) {
    $pieces = explode('-', basename($file, '.rrd'));
    $hostname = end($pieces);
    list($host, $port) = explode('_', $hostname, 2);
    $rrd_list[] = array(
        'filename' => $file,
        'descr'    => $host.':'.$port,
        'ds_in'    => $ds_in,
        'ds_out'   => $ds_out
    );
}

require 'includes/graphs/generic_multi_bits_separated.inc.php';
