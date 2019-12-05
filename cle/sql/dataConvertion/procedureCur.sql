drop procedure if exists cur;
CREATE PROCEDURE cur()
BLOCK1: begin
  DECLARE done_block1 INT DEFAULT 0;
  /* data */
  declare _ResourcesID int(11);
  declare _CMS_ID int(11);
  declare _URL varchar(255);
  declare _ResourceName varchar(255);
  declare _author varchar(255);
  declare _TeachingAims MEDIUMTEXT;
  declare _Lv1 varchar(255);
  declare _Lv2 varchar(10);
  declare _Lv3 varchar(10);
  declare _Lv4 varchar(10);
  declare _Lv5 varchar(10);
  declare _Lv6 varchar(10);
  declare _Lv7 varchar(10);
  declare _Lv1_Text varchar(255);
  declare _Lv2_Text varchar(255);
  declare _Lv3_Text varchar(255);
  declare _Lv4_Text varchar(255);
  declare _Lv5_Text varchar(255);
  declare _Lv6_Text varchar(255);
  declare _Lv7_Text varchar(255);


  DECLARE curOrig CURSOR FOR SELECT * FROM todave;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block1 = 1;

  OPEN curOrig;


  origLoop: LOOP
    FETCH curOrig INTO _ResourcesID, _CMS_ID, _URL, _ResourceName, _author, _TeachingAims, _Lv1, _Lv2, _Lv3, _Lv4, _Lv5, _Lv6, _Lv7, _Lv1_Text, _Lv2_Text, _Lv3_Text, _Lv4_Text, _Lv5_Text, _Lv6_Text, _Lv7_Text;

    IF done_block1 THEN
      CLOSE curOrig;
      LEAVE origLoop;
    END IF;
  
    /*
    select Lv1_Text, Lv2_Text, Lv3_Text, Lv4_Text;
    */
    /*select 'loop1';*/

    /* #################### block 2 ###################### */
    BLOCK2: BEGIN

    DECLARE done_block2 INT DEFAULT 0;
    /* type */
    declare _sid int(11);
    declare _Seq int(11);
    declare _LV int(11);
    declare _LV_Text varchar(255);
    declare _UpLV_sid int(11);
    declare _IsShown BOOLEAN;
    declare _typeurl varchar(255);
    declare _Remarks MEDIUMTEXT;
    declare _LastUpdate timestamp;

    DECLARE curType CURSOR FOR SELECT * FROM cle_resourcetype;    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block2 = 1;
    OPEN curType;

    typeLoop: LOOP
        FETCH curType INTO _sid, _Seq, _LV, _LV_Text, _UpLV_sid, _IsShown, _typeurl, _Remarks, _LastUpdate;
    
    IF done_block2 THEN
      CLOSE curType;
      LEAVE typeLoop;
    END IF;
    
    /* select 'loop2';*/

    if rtrim(ltrim(_LV5_Text)) != '-' then
      if rtrim(ltrim(_LV5_Text)) = _LV_Text then
        insert into cle_resource (URL, ResourceName, Author, TeachingAims, Type_sid)
        values(_URL, _ResourceName, _author, _TeachingAims, _sid);
      end if;
    else /* lv5 else */
      if rtrim(ltrim(_LV4_Text)) != '-' then
        if rtrim(ltrim(_LV4_Text)) = _LV_Text then
          insert into cle_resource (URL, ResourceName, Author, TeachingAims, Type_sid)
          values(_URL, _ResourceName, _author, _TeachingAims, _sid);
        end if;
      else /* lv4 else */
       
        if rtrim(ltrim(_LV3_Text)) != '-' then
          if rtrim(ltrim(_LV3_Text)) = _LV_Text then
            insert into cle_resource (URL, ResourceName, Author, TeachingAims, Type_sid)
            values(_URL, _ResourceName, _author, _TeachingAims, _sid);
          end if;
        else /* lv3 else */
         
          if rtrim(ltrim(_LV2_Text)) != '-' then
            if rtrim(ltrim(_LV2_Text)) = _LV_Text then
              insert into cle_resource (URL, ResourceName, Author, TeachingAims, Type_sid)
              values(_URL, _ResourceName, _author, _TeachingAims, _sid);
            end if;
          else /* lv2 else */
           
            if rtrim(ltrim(_LV1_Text)) != '-' then
              if rtrim(ltrim(_LV1_Text)) = _LV_Text then
                insert into cle_resource (URL, ResourceName, Author, TeachingAims, Type_sid)
                values(_URL, _ResourceName, _author, _TeachingAims, _sid);
              end if;     
            end if; /* lv1 end if...else */

          end if; /* lv2 end if...else */

        end if; /* lv3 end if...else */

      end if; /* lv4 end if...else */     
    end if; /* lv5 end if...else */


    /*
    select LV_Text as typeLoop;
    */
  
    END LOOP typeLoop;
    END BLOCK2;
    /* ################### end block 2 #################### */

  END LOOP origLoop;
end BLOCK1;