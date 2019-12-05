delete from cle_resourcetype;
drop procedure if exists testPro;

CREATE PROCEDURE testPro()
BLOCK: begin
    ALTER TABLE cle_resourcetype AUTO_INCREMENT = 0;
    declare _maxSeq int default 0;
    set _maxSeq = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 0);
    set _maxSeq = _maxSeq + 1;

    insert into cle_resourcetype
    (Seq, LV, LV_Text, UpLV_sid)
    select distinct _maxSeq as Seq, 0 as LV, LV1_Text as LV_Text, null as UpLV_sid from vwrallresources;
end BLOCK;

