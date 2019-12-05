package flex.vo
{
	import flash.utils.ByteArray;
	
	import flex.common.Misc;
	
	import mx.controls.Alert;
	
	public class FileCabinet
	{
		// FileCabinet
		public var sid:Number;
		public var seq:Number;
		public var activitySid:Number;
		public var fileNameEn:String;
		public var fileNameTc:String;
		public var descriptionEn:String;
		public var descriptionTc:String;
		public var fileTypeSid:Number;
		public var filePath:String;
		public var isShown:Boolean;
		public var remarks:String;
		public var fileDate:Date;
		public var lastUpdate:Date;
		
		// Activity
		public var sidA:Number;
		public var seqA:Number;
		public var activityNameEnA:String;
		public var activityNameTcA:String;
		public var contentEnA:String;
		public var contentTcA:String;
		public var speakerEnA:String;
		public var speakerTcA:String;
		public var isShownA:Boolean;
		public var activityDateA:Date;
		public var remarksA:String;
		public var lastUpdateA:Date;	
		
		// FileType
		public var sidT:Number;
		public var fileTypeEnT:String;
		public var fileTypeTcT:String;
		public var fileTypeIconT:ByteArray;
		public var remarksT:String;
		public var lastUpdateT:Date;		
		
		public function obj2Me(_item:*):FileCabinet
		{
			// FileCabinet
			this.sid = _item.sid;
			this.seq = _item.seq;
			this.activitySid = _item.activitySid;
			this.fileNameEn = _item.fileNameEn;
			this.fileNameTc = _item.fileNameTc;
			this.descriptionEn = _item.descriptionEn;
			this.descriptionTc = _item.descriptionTc;
			this.fileTypeSid = _item.fileTypeSid;
			this.filePath = _item.filePath;
			this.isShown = _item.isShown;
			this.remarks = _item.remarks;

			this.fileDate = Misc.parseUTCDate(_item.fileDate);
			this.lastUpdate = Misc.parseUTCDate(_item.lastUpdate);
			
			// Activity
			this.sidA = _item.sidA;
			this.seqA = _item.seqA;
			this.activityNameEnA = _item.activityNameEnA;
			this.activityNameTcA = _item.activityNameTcA;
			this.contentEnA = _item.contentEnA;
			this.contentTcA = _item.contentTcA;
			this.speakerEnA = _item.speakerEnA;
			this.speakerTcA = _item.speakerTcA;
			this.isShownA = _item.isShownA;
			
			this.activityDateA = Misc.parseUTCDate(_item.activityDateA);
			this.remarksA = _item.remarksA;
			this.lastUpdateA =Misc.parseUTCDate(_item.lastUpdateA);
			
			// FileType
			this.sidT = _item.sidT;
			this.fileTypeEnT = _item.fileTypeEnT;
			this.fileTypeTcT = _item.fileTypeTcT;
			this.fileTypeIconT = _item.fileTypeIconT;
			this.remarksT = _item.remarksT;
			this.lastUpdateT = Misc.parseUTCDate(_item.lastUpdateT);				
			return this;
		}
		
		public function FileCabinet()
		{
		}
	}
}