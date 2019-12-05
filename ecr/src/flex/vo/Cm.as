package flex.vo
{
	import flash.utils.ByteArray;
	
	import flex.common.Misc;
	
	import mx.controls.Alert;
	import mx.utils.Base64Decoder;
	public class Cm extends VoBase
	{
		// Cm
		public var sid:Number;
		public var objPageSid:Number;
		public var contentEn:String;
		public var contentTc:String;
		public var contentHtmlEn:String;
		public var contentHtmlTc:String;
		public var remarks:String;
		public var lastUpdate:Date;
		
		// ObjPage
		public var sidO:Number;
		public var pageO:String;
		public var urlO:String;
		public var remarksO:String;
		public var lastUpdateO:Date;
		
		public function obj2Me(_item:*):Cm
		{
			var base64DecoderContentEn:Base64Decoder = new Base64Decoder();	
			var base64DecoderContentTc:Base64Decoder = new Base64Decoder();
			var base64DecoderContentHtmlEn:Base64Decoder = new Base64Decoder();	
			var base64DecoderContentHtmlTc:Base64Decoder = new Base64Decoder();			
			
			// Cm
			this.sid = _item.sid;
			this.objPageSid = _item.objPageSid;
			
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
			
			this.remarks = _item.remarks;
			this.lastUpdate =Misc.parseUTCDate(_item.lastUpdate);
			
			// ObjPage
			this.sidO = _item.sidO;
			this.pageO = _item.pageO;
			this.urlO = _item.urlO;
			this.remarksO = _item.remarksO;
			this.lastUpdateO = Misc.parseUTCDate(_item.lastUpdateO);
			
			return this;
		}				
		public function Cm()
		{
			
		}
	} // end class
} // end package