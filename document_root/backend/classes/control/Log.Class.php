<?
	class Log extends Control{
		function __construct($label="default", $msg){
			self::logMsg($label, $msg);
		}
		public function logMsg($label="default", $msg){
			$now = date('D Y/M/d h:i:s A');
			$bt = debug_backtrace();
			$file = $bt[1]['file'];
			$line = $bt[1]['line'];
			error_log("$now \t[$label] \t$msg \t$file \n", 3, SITEPATH."/errors-monitor.log");
		}
	}
?>
