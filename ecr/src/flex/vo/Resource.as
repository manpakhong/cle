package flex.vo
{
	import flex.common.Misc;
	
	import mx.controls.Alert;
	import mx.utils.Base64Decoder;	
	
	public class Resource extends VoBase
	{
		// resource
		public var sid:Number;
		public var seq:Number;
		public var url:String;
		public var resourceNameEn:String;
		public var resourceNameTc:String;
		public var authorEn:String;
		public var authorTc:String;
		public var briefingEn:String;
		public var briefingTc:String;
		public var briefingHtmlEn:String;
		public var briefingHtmlTc:String;
		public var typeMenuSid:Number;
		public var typeSid:Number;
		public var imageUrl:String;
		public var isShown:Boolean;
		public var remarks:String;
		public var lastUpdate:Date;
		
		// menubar
		public var sidM:Number;
		public var seqM:Number;
		public var lvM:Number;
		public var lvTextEnM:String;
		public var lvTextTcM:String;
		public var upLvSidM:Number;
		public var isShownM:Boolean;
		public var isNetvigatedM:Boolean;
		public var urlM:String;
		public var remarksM:String;
		public var lastUpdateM:Date;
		
		// type
		public var sidT:Number;
		public var typeEnT:Number;
		public var typeTcT:Number;
		public var remarksT:String;
		public var lastUpdateT:Date;
		
		public function obj2Me(_item:*):Resource
		{		
			
			// resource
			var base64DecoderBriefingEn:Base64Decoder = new Base64Decoder();	
			var base64DecoderBriefingTc:Base64Decoder = new Base64Decoder();
			var base64DecoderBriefingHtmlEn:Base64Decoder = new Base64Decoder();
			var base64DecoderBriefingHtmlTc:Base64Decoder = new Base64Decoder();
			
			this.sid = _item.sid;
			this.seq = _item.seq;
			this.url = _item.url;
			this.resourceNameEn = _item.resourceNameEn;
			this.resourceNameTc = _item.resourceNameTc;
			this.authorEn = _item.authorEn;
			this.authorTc = _item.authorTc;
			
			
			this.briefingEn =_item.briefingEn;
			if (this.briefingEn != null)
			{
				base64DecoderBriefingEn.decode(this.briefingEn);
				this.briefingEn = base64DecoderBriefingEn.toByteArray().toString();
			}
			
			
			this.briefingTc = _item.briefingTc;			
			if (this.briefingTc != null)
			{
				base64DecoderBriefingTc.decode(this.briefingTc);
				this.briefingTc = base64DecoderBriefingTc.toByteArray().toString();
			}			
			
			this.briefingHtmlEn =_item.briefingHtmlEn;
			if (this.briefingHtmlEn != null)
			{
				base64DecoderBriefingHtmlEn.decode(this.briefingHtmlEn);
				this.briefingHtmlEn = base64DecoderBriefingHtmlEn.toByteArray().toString();
			}
			
			
			this.briefingHtmlTc = _item.briefingHtmlTc;			
			if (this.briefingHtmlTc != null)
			{
				base64DecoderBriefingHtmlTc.decode(this.briefingHtmlTc);
				this.briefingHtmlTc = base64DecoderBriefingHtmlTc.toByteArray().toString();
			}				
			
			this.typeMenuSid = _item.typeMenuSid;
			this.typeSid = _item.typeSid;
			this.imageUrl = _item.imageUrl;
			this.isShown = this.checkNconvert2Boolean(_item.isShown);	
			this.remarks = _item.remarks;
			this.lastUpdate =Misc.parseUTCDate(_item.lastUpdate);
			
			// menubar
			this.sidM = _item.sidM;
			this.seqM = _item.seqM;
			this.lvM = _item.lvM;
			this.lvTextEnM = _item.lvTextEnM;
			this.lvTextTcM = _item.lvTextTcM;
			this.upLvSidM = _item.upLvSidM;
			this.isShownM = _item.isShownM;
			this.isNetvigatedM = _item.isNetvigatedM;
			this.urlM = _item.urlM;
			this.remarksM = _item.remarksM;
			this.lastUpdateM = Misc.parseUTCDate(_item.lastUpdateM);
			
			// type
			this.sidT = _item.sidT;
			this.typeEnT = _item.typeEnT;
			this.typeTcT = _item.typeTcT;
			this.remarksT = _item.remarksT;
			this.lastUpdateT = Misc.parseUTCDate(_item.lastUpdateT);
			
			return this;
		}			
		public function Resource()
		{
		}
	} // end class
} // end package