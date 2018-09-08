<?php

require 'vendor/autoload.php';

use GuzzleHttp\Psr7;

$stream = Psr7\stream_for('this is a stream data');

echo $stream.'<br>';
echo $stream->getSize(). '</br>';
echo $stream->isReadable(). '</br>';
echo $stream->isSeekable(). '</br>';
echo $stream->isWritable(). '</br>';

$stream->write('test');

$stream->rewind();

echo $stream->read(5).'</br>';

echo $stream->getContents().'</br>';
echo $stream->eof() .'</br>';