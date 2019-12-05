select r.sid, r.Seq, r.url, r.ResourceName_En, r.ResourceName_Tc,
r.Author_En, r.Author_Tc, r.Briefing_En, r.Briefing_Tc,
r.BriefingHtml_En, r.BriefingHtml_Tc, r.TypeMenu_sid,
r.Type_sid, r.Image_url, r.IsShown, r.Remarks, r.LastUpdate,
m.sid as sidM,
m.Seq as SeqM,
m.LV as LVM,
m.LV_Text_En as LV_Text_EnM,
m.LV_Text_Tc as LV_Text_TcM,
m.UpLV_sid as UpLV_sidM,
m.IsShown as IsShownM,
m.IsNetvigated as IsNetvigatedM,
m.url as urlM,
m.Remarks as RemarksM,
m.LastUpdate as LastUpdateM,
t.sid as sidT,
t.Type_En as Type_EnT,
t.Type_Tc as Type_TcT,
t.Remarks as RemarksT,
t.LastUpdate as LastUpdateT
from ecr_resource r
left join ecr_menubar m
on r.TypeMenu_sid = m.sid
left join ecr_type t
on r.Type_sid = t.sid