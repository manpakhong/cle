package flex.validators
{
	import mx.validators.ValidationResult;
	import mx.validators.Validator;
	
	public class DateRangeValidator extends Validator
	{
		private var results:Array;
		
		public function DateRangeValidator()
		{
			super();
		}
		
		override protected function doValidation(value:Object):Array
		{
			var dateFrom:String = value.dateFrom;
			var dateTo:String = value.dateTo;
			
			// clear results Array
			results = [];
			
			results = super.doValidation(value);
			
			if (results.length > 0)
			{
				return results;
			}
			
			if (dateFrom != null)
			{
				if (dateTo == null)
				{
					results.push(new ValidationResult(true, "dateTo" , "hasDateFromNoDateTo" , 
						"Once Date from has data input, Date to must have input too!"));
				}
			}
			
			if (dateTo != null)
			{
				if (dateFrom == null)
				{
					results.push(new ValidationResult(true, "dateFrom" , "hasDateToNoDateFrom" , 
						"Once Date to has data input, Date from must have input too!"));
				}
			}
			return results;
		} // end doValidation
	} // end class
} // end package