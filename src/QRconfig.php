<?php
namespace QRcode;

defined('QRcode_QR_APPPATH') or define('QRcode_QR_APPPATH', __DIR__);

class QRconfig
{
	const QR_APPPATH          = QRcode_QR_APPPATH;
	const QR_CACHEABLE        = true;  // use cache - more disk reads but less CPU power, masks and format templates are stored there
	const QR_CACHE_DIR        = QRcode_QR_APPPATH . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR; // used when QR_CACHEABLE === true
	const QR_LOG_DIR          = QRcode_QR_APPPATH . DIRECTORY_SEPARATOR; // default error logs dir
	const QR_FIND_BEST_MASK   = true;  // if true, estimates best mask (spec. default, but extremally slow; set to false to significant performance boost but (propably) worst quality code
	const QR_FIND_FROM_RANDOM = false; // if false, checks all masks available, otherwise value tells count of masks need to be checked, mask id are got randomly
	const QR_DEFAULT_MASK     = 2;     // when QR_FIND_BEST_MASK === false
	const QR_PNG_MAXIMUM_SIZE = 1024;  // maximum allowed png image width (in pixels), tune to make sure GD and PHP can handle such big images

	const QR_IMAGE = true;
}