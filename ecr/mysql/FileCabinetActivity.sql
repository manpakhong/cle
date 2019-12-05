select fc.*, 
a.sid as sidA,
a.Seq as SeqA, 
a.Activity_Name_En as Activity_Name_EnA,
a.Activity_Name_Tc as Activity_Name_TcA,
a.Content_En as Content_EnA,
a.Content_Tc as Content_TcA,
a.ContentHtml_En as ContentHtml_EnA,
a.ContentHtml_Tc as ContentHtml_TcA,
a.Speaker_En as Speaker_EnA,
a.Speaker_Tc as Speaker_TcA, 
a.IsShown as IsShownA,
a.Activity_Date as Activity_DateA,
a.Remarks as RemarksA,
a.LastUpdate as LastUpdateA,
t.sid as sidT,
t.File_Type_En as File_Type_EnT,
t.File_Type_Tc as File_Type_TcT,
t.File_Type_Icon as File_Type_IconT,
t.Remarks as RemarksT,
t.LastUpdate as LastUpdateT
from ecr_filecabinet fc 
left join ecr_activity a on fc.Activity_sid = a.sid
left join ecr_filetype t on t.sid = fc.FileType_sid
; 