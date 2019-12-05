package flex.validators
{
	import mx.validators.Validator;
	import mx.validators.ValidationResult;
	
	public class RadioDialogBoxValidator extends Validator
	{
		private var results:Array;		
		public function RadioDialogBoxValidator()
		{
			super();
		}
		override protected function doValidation(value:Object):Array
		{
			var isShown_Y:String = value.isShown_Y;
			var isShown_N:String = value.isShown_N;
			
			// clear results Array
			results = [];
			
			results = super.doValidation(value);
			
			if (results.length > 0)
			{
				return results;
			}
			
			if (isShown_Y == "false" && isShown_N == "false")
			{
				results.push(new ValidationResult(true, "isShown" , "nullIsShown" , 
						"Either Yes or No must be selected!"));
			}

			return results;
		} // end doValidation		
	}
}