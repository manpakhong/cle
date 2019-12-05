select a.ResourceName as AResourceName, a.Type_sid as ATypeSid,
b.sid as Bsid, b.LV_Text as BLvText
from cle_resource a left join cle_resourcetype b on
a.type_sid = b.sid; 