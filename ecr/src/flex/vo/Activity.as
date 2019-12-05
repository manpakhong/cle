package flex.vo
{
	import flash.utils.ByteArray;
	import flex.common.Misc;
	import mx.controls.Alert;
	import mx.utils.Base64Decoder;
	
	public class Activity extends VoBase
	{
		public var sid:Number;
		public var seq:Number;
		public var activityNameEn:String;
		public var activityNameTc:String;
		public var contentEn:String;
		public var contentTc:String;
		public var contentHtmlEn:String;
		public var contentHtmlTc:String;
		public var speakerEn:String;
		public var speakerTc:String;
		public var isShown:Boolean;
		public var activityDate:Date;
		public var activityDateFrom:Date;
		public var activityDateTo:Date;
		public var remarks:String;
		public var lastUpdate:Date;
		
		public function obj2Me(_item:*):Activity
		{
			var base64DecoderContentEn:Base64Decoder = new Base64Decoder();	
			var base64DecoderContentTc:Base64Decoder = new Base64Decoder();
			var base64DecoderContentHtmlEn:Base64Decoder = new Base64Decoder();	
			var base64DecoderContentHtmlTc:Base64Decoder = new Base64Decoder();			
			
			// Activity
			this.sid = _item.sid;
			this.seq = _item.seq;
			this.activityNameEn = _item.activityNameEn;
			this.activityNameTc = _item.activityNameTc;
			
			this.contentEn =_item.contentEn;
			if (this.contentEn != null)
			{
				base64DecoderContentEn.decode(this.contentEn);
				this.contentEn = base64DecoderContentEn.toByteArray().toString();
			}
			
			
			this.contentTc = _item.contentTc;			
			if (this.contentTc != null)
			{
				base64DecoderContentTc.decode(this.contentTc);
				this.contentTc = base64DecoderContentTc.toByteArray().toString();
			}
			
			this.contentHtmlEn =_item.contentHtmlEn;
			if (this.contentHtmlEn != null)
			{
				base64DecoderContentHtmlEn.decode(this.contentHtmlEn);
				this.contentHtmlEn = base64DecoderContentHtmlEn.toByteArray().toString();
			}
			
			this.contentHtmlTc = _item.contentHtmlTc;	
			if (this.contentHtmlTc != null)
			{
				base64DecoderContentHtmlTc.decode(this.contentHtmlTc);
				this.contentHtmlTc = base64DecoderContentHtmlTc.toByteArray().toString();			
			}
			
			
			this.speakerEn = _item.speakerEn;
			this.speakerTc = _item.speakerTc;
			this.isShown = this.checkNconvert2Boolean(_item.isShown);
			this.activityDate = Misc.parseUTCDate(_item.activityDate);
			this.activityDateFrom = Misc.parseUTCDate(_item.activityDateFrom);
			this.activityDateTo = Misc.parseUTCDate(_item.activityDateTo);
			this.remarks = _item.remarks;
			this.lastUpdate =Misc.parseUTCDate(_item.lastUpdate);
			
			return this;
		}		
		
		public function Activity()
		{
		}
		
		
	} // end class
} // end package