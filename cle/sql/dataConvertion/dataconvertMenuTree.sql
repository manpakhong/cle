drop procedure if exists importTreeMenu;
CREATE PROCEDURE importTreeMenu()
BLOCKALL: begin
  declare _maxSeq int default 0;

  -- data fields from Annie
  declare _LVA_Text varchar(255);
  declare _LVB_Text varchar(255);
  delete from cle_resourcetype;

  BLOCK0: begin
    declare _maxSeq int default 0;
    ALTER TABLE cle_resourcetype AUTO_INCREMENT = 0;
    set _maxSeq = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 0);
    set _maxSeq = _maxSeq + 1;

    insert into cle_resourcetype
    (Seq, LV, LV_Text, UpLV_sid)
    select distinct _maxSeq as Seq, 0 as LV, LV1_Text as LV_Text, null as UpLV_sid from vwrallresources;
  end BLOCK0;

  BLOCK1: begin

    -- insert 首頁 
    declare _maxSeq1a int default 0;
  	declare done_block1a INT DEFAULT 0;	  	
    declare _maxSeq1b int default 0;
  	DECLARE curSource1 CURSOR FOR 
  		SELECT distinct LV1_Text as LVA_Text, LV2_Text as LVB_Text FROM vwrallresources 
  		where Lv2_Text != '-' and length(TRIM(Lv2_Text)) > 0;
  	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block1a = 1;	

    set _maxSeq1a = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 1);
    set _maxSeq1a = _maxSeq1a + 1;
	
    

    insert into cle_resourcetype
    (Seq, LV, LV_Text, UpLV_sid)
    select distinct _maxSeq1a as Seq, 1 as LV, '首頁' as LV_Text, null as UpLV_sid from vwrallresources;

  	-- ############################################################################################################
      -- get LV 
  	
  
  	OPEN curSource1;
  
  
  	SOURCELOOP1: LOOP
    	FETCH curSource1 INTO _LVA_Text, _LVB_Text;
    
    	IF done_block1a THEN
    	  CLOSE curSource1;
    	  LEAVE SOURCELOOP1;
    	END IF;
  

    	TARGETBLOCK1: BEGIN
    
      	DECLARE done_block1b INT DEFAULT 0;
      	-- cle_resoucetype
      	declare _sid int(11);
      	declare _Seq int(11);
      	declare _LV int(11);
      	declare _LV_Text varchar(255);
      	declare _UpLV_sid int(11);
      	declare _IsShown BOOLEAN;
      	declare _IsNetvigated BOOLEAN;
      	declare _url varchar(255);
      	declare _Remarks MEDIUMTEXT;
      	declare _LastUpdate timestamp;
        declare _maxSeq1n int default 0;    
      	DECLARE curTarget1 CURSOR FOR 
      	    select * from cle_resourcetype where LV = 0;
      	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block1b = 1;
      	OPEN curTarget1;
    
    	  TARGETLOOP1: LOOP
		      FETCH curTarget1 INTO _sid, _Seq, _LV, _LV_Text, _UpLV_sid, _IsShown, _IsNetvigated, _url, _Remarks, _LastUpdate;

        	IF done_block1b THEN
        	  CLOSE curTarget1;
        	  LEAVE TARGETLOOP1;
        	END IF;    
          set _maxSeq1n = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 1);
          set _maxSeq1n = _maxSeq1n + 1;	
        	if _LVA_Text = _LV_Text then
        		insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid)
        		select _maxSeq1n as Seq, 1 as LV, _LVB_Text as LV_Text, _sid as UpLV_sid;
        	end if;
        END LOOP TARGETLOOP1;
      END TARGETBLOCK1;

  
  	END LOOP SOURCELOOP1;

	
    -- insert 其他網站連結 

    set _maxSeq1b = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 1);
    set _maxSeq1b = _maxSeq1b + 1;
	
    insert into cle_resourcetype
    (Seq, LV, LV_Text, UpLV_sid)
    select distinct _maxSeq1b as Seq, 1 as LV, '其他網站連結' as LV_Text, null as UpLV_sid from vwrallresources;
  end BLOCK1;

  BLOCK2: begin

    declare _maxSeq2a int default 0;
  	declare done_block2a INT DEFAULT 0;	  	
    declare _maxSeq2b int default 0;
  	DECLARE curSource2 CURSOR FOR 
  		SELECT distinct LV2_Text as LVA_Text, LV3_Text as LVB_Text FROM vwrallresources 
  		where Lv3_Text != '-' and length(TRIM(Lv3_Text)) > 0;
  	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block2a = 1;	

    set _maxSeq2a = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 2);
    set _maxSeq2a = _maxSeq2a + 1;
	
  	-- ############################################################################################################
      -- get LV 
  	
  
  	OPEN curSource2;
  
  
  	SOURCELOOP2: LOOP
    	FETCH curSource2 INTO _LVA_Text, _LVB_Text;
    
    	IF done_block2a THEN
    	  CLOSE curSource2;
    	  LEAVE SOURCELOOP2;
    	END IF;
  

    	TARGETBLOCK2: BEGIN
    
      	DECLARE done_block2b INT DEFAULT 0;
      	-- cle_resoucetype
      	declare _sid int(11);
      	declare _Seq int(11);
      	declare _LV int(11);
      	declare _LV_Text varchar(255);
      	declare _UpLV_sid int(11);
      	declare _IsShown BOOLEAN;
      	declare _IsNetvigated BOOLEAN;
      	declare _url varchar(255);
      	declare _Remarks MEDIUMTEXT;
      	declare _LastUpdate timestamp;
        declare _maxSeq2n int default 0;    
      	DECLARE curTarget2 CURSOR FOR 
      	    select * from cle_resourcetype where LV = 1;
      	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block2b = 1;
      	OPEN curTarget2;
    
    	  TARGETLOOP2: LOOP
		      FETCH curTarget2 INTO _sid, _Seq, _LV, _LV_Text, _UpLV_sid, _IsShown, _IsNetvigated, _url, _Remarks, _LastUpdate;

        	IF done_block2b THEN
        	  CLOSE curTarget2;
        	  LEAVE TARGETLOOP2;
        	END IF;    
          set _maxSeq2n = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 2);
          set _maxSeq2n = _maxSeq2n + 1;	
        	if _LVA_Text = _LV_Text then
        		insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid)
        		select _maxSeq2n as Seq, 2 as LV, _LVB_Text as LV_Text, _sid as UpLV_sid;
        	end if;
        END LOOP TARGETLOOP2;
      END TARGETBLOCK2;

  
  	END LOOP SOURCELOOP2;

  end BLOCK2;


  BLOCK3: begin
    declare _maxSeq3a int default 0;
  	declare done_block3a INT DEFAULT 0;	  	
    declare _maxSeq3b int default 0;
  	DECLARE curSource3 CURSOR FOR 
  		SELECT distinct LV3_Text as LVA_Text, LV4_Text as LVB_Text FROM vwrallresources 
  		where Lv4_Text != '-' and length(TRIM(Lv4_Text)) > 0;
  	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block3a = 1;	

    set _maxSeq3a = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 3);
    set _maxSeq3a = _maxSeq3a + 1;
	
  	-- ############################################################################################################
      -- get LV 
  	
  
  	OPEN curSource3;
  
  
  	SOURCELOOP3: LOOP
    	FETCH curSource3 INTO _LVA_Text, _LVB_Text;
    
    	IF done_block3a THEN
    	  CLOSE curSource3;
    	  LEAVE SOURCELOOP3;
    	END IF;
  

    	TARGETBLOCK3: BEGIN
    
      	DECLARE done_block3b INT DEFAULT 0;
      	-- cle_resoucetype
      	declare _sid int(11);
      	declare _Seq int(11);
      	declare _LV int(11);
      	declare _LV_Text varchar(255);
      	declare _UpLV_sid int(11);
      	declare _IsShown BOOLEAN;
      	declare _IsNetvigated BOOLEAN;
      	declare _url varchar(255);
      	declare _Remarks MEDIUMTEXT;
      	declare _LastUpdate timestamp;
        declare _maxSeq3n int default 0;    
      	DECLARE curTarget3 CURSOR FOR 
      	    select * from cle_resourcetype where LV = 2;
      	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block3b = 1;
      	OPEN curTarget3;
    
    	  TARGETLOOP3: LOOP
		      FETCH curTarget3 INTO _sid, _Seq, _LV, _LV_Text, _UpLV_sid, _IsShown, _IsNetvigated, _url, _Remarks, _LastUpdate;

        	IF done_block3b THEN
        	  CLOSE curTarget3;
        	  LEAVE TARGETLOOP3;
        	END IF;    
          set _maxSeq3n = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 3);
          set _maxSeq3n = _maxSeq3n + 1;	
        	if _LVA_Text = _LV_Text then
        		insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid)
        		select _maxSeq3n as Seq, 3 as LV, _LVB_Text as LV_Text, _sid as UpLV_sid;
        	end if;
        END LOOP TARGETLOOP3;
      END TARGETBLOCK3;

  
  	END LOOP SOURCELOOP3;
  end BLOCK3;
  BLOCK4: begin
    declare _maxSeq4a int default 0;
  	declare done_block4a INT DEFAULT 0;	  	
    declare _maxSeq4b int default 0;
  	DECLARE curSource4 CURSOR FOR 
  		SELECT distinct LV4_Text as LVA_Text, LV5_Text as LVB_Text FROM vwrallresources 
  		where Lv5_Text != '-' and length(TRIM(Lv5_Text)) > 0;
  	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block4a = 1;	

    set _maxSeq4a = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 4);
    set _maxSeq4a = _maxSeq4a + 1;
	
  	-- ############################################################################################################
      -- get LV 
  	
  
  	OPEN curSource4;
  
  
  	SOURCELOOP4: LOOP
    	FETCH curSource4 INTO _LVA_Text, _LVB_Text;
    
    	IF done_block4a THEN
    	  CLOSE curSource4;
    	  LEAVE SOURCELOOP4;
    	END IF;
  

    	TARGETBLOCK4: BEGIN
    
      	DECLARE done_block4b INT DEFAULT 0;
      	-- cle_resoucetype
      	declare _sid int(11);
      	declare _Seq int(11);
      	declare _LV int(11);
      	declare _LV_Text varchar(255);
      	declare _UpLV_sid int(11);
      	declare _IsShown BOOLEAN;
      	declare _IsNetvigated BOOLEAN;
      	declare _url varchar(255);
      	declare _Remarks MEDIUMTEXT;
      	declare _LastUpdate timestamp;
        declare _maxSeq4n int default 0;    
      	DECLARE curTarget4 CURSOR FOR 
      	    select * from cle_resourcetype where LV = 3;
      	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block4b = 1;
      	OPEN curTarget4;
    
    	  TARGETLOOP4: LOOP
		      FETCH curTarget4 INTO _sid, _Seq, _LV, _LV_Text, _UpLV_sid, _IsShown, _IsNetvigated, _url, _Remarks, _LastUpdate;

        	IF done_block4b THEN
        	  CLOSE curTarget4;
        	  LEAVE TARGETLOOP4;
        	END IF;    
          set _maxSeq4n = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 4);
          set _maxSeq4n = _maxSeq4n + 1;	
        	if _LVA_Text = _LV_Text then
        		insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid)
        		select _maxSeq4n as Seq, 4 as LV, _LVB_Text as LV_Text, _sid as UpLV_sid;
        	end if;
        END LOOP TARGETLOOP4;
      END TARGETBLOCK4;

  
  	END LOOP SOURCELOOP4;
  end BLOCK4;
  BLOCK5: begin
    declare _maxSeq5a int default 0;
  	declare done_block5a INT DEFAULT 0;	  	
    declare _maxSeq5b int default 0;
  	DECLARE curSource5 CURSOR FOR 
  		SELECT distinct LV5_Text as LVA_Text, LV6_Text as LVB_Text FROM vwrallresources 
  		where Lv6_Text != '-' and length(TRIM(Lv6_Text)) > 0;
  	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block5a = 1;	

    set _maxSeq5a = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 5);
    set _maxSeq5a = _maxSeq5a + 1;
	
  	-- ############################################################################################################
      -- get LV 
  	
  
  	OPEN curSource5;
  
  
  	SOURCELOOP5: LOOP
    	FETCH curSource5 INTO _LVA_Text, _LVB_Text;
    
    	IF done_block5a THEN
    	  CLOSE curSource5;
    	  LEAVE SOURCELOOP5;
    	END IF;
  

    	TARGETBLOCK5: BEGIN
    
      	DECLARE done_block5b INT DEFAULT 0;
      	-- cle_resoucetype
      	declare _sid int(11);
      	declare _Seq int(11);
      	declare _LV int(11);
      	declare _LV_Text varchar(255);
      	declare _UpLV_sid int(11);
      	declare _IsShown BOOLEAN;
      	declare _IsNetvigated BOOLEAN;
      	declare _url varchar(255);
      	declare _Remarks MEDIUMTEXT;
      	declare _LastUpdate timestamp;
        declare _maxSeq5n int default 0;    
      	DECLARE curTarget5 CURSOR FOR 
      	    select * from cle_resourcetype where LV = 4;
      	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block5b = 1;
      	OPEN curTarget5;
    
    	  TARGETLOOP5: LOOP
		      FETCH curTarget5 INTO _sid, _Seq, _LV, _LV_Text, _UpLV_sid, _IsShown, _IsNetvigated, _url, _Remarks, _LastUpdate;

        	IF done_block5b THEN
        	  CLOSE curTarget5;
        	  LEAVE TARGETLOOP5;
        	END IF;    
          set _maxSeq5n = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 5);
          set _maxSeq5n = _maxSeq5n + 1;	
        	if _LVA_Text = _LV_Text then
        		insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid)
        		select _maxSeq5n as Seq, 5 as LV, _LVB_Text as LV_Text, _sid as UpLV_sid;
        	end if;
        END LOOP TARGETLOOP5;
      END TARGETBLOCK5;

  
  	END LOOP SOURCELOOP5;
  end BLOCK5;
  BLOCK6: begin
    declare _maxSeq6a int default 0;
  	declare done_block6a INT DEFAULT 0;	  	
    declare _maxSeq6b int default 0;
  	DECLARE curSource6 CURSOR FOR 
  		SELECT distinct LV6_Text as LVA_Text, LV7_Text as LVB_Text FROM vwrallresources 
  		where Lv7_Text != '-' and length(TRIM(Lv7_Text)) > 0;
  	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block6a = 1;	

    set _maxSeq6a = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 6);
    set _maxSeq6a = _maxSeq6a + 1;
	
  	-- ############################################################################################################
      -- get LV 
  	
  
  	OPEN curSource6;
  
  
  	SOURCELOOP6: LOOP
    	FETCH curSource6 INTO _LVA_Text, _LVB_Text;
    
    	IF done_block6a THEN
    	  CLOSE curSource6;
    	  LEAVE SOURCELOOP6;
    	END IF;
  

    	TARGETBLOCK6: BEGIN
    
      	DECLARE done_block6b INT DEFAULT 0;
      	-- cle_resoucetype
      	declare _sid int(11);
      	declare _Seq int(11);
      	declare _LV int(11);
      	declare _LV_Text varchar(255);
      	declare _UpLV_sid int(11);
      	declare _IsShown BOOLEAN;
      	declare _IsNetvigated BOOLEAN;
      	declare _url varchar(255);
      	declare _Remarks MEDIUMTEXT;
      	declare _LastUpdate timestamp;
        declare _maxSeq6n int default 0;    
      	DECLARE curTarget6 CURSOR FOR 
      	    select * from cle_resourcetype where LV = 5;
      	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_block6b = 1;
      	OPEN curTarget6;
    
    	  TARGETLOOP6: LOOP
		      FETCH curTarget6 INTO _sid, _Seq, _LV, _LV_Text, _UpLV_sid, _IsShown, _IsNetvigated, _url, _Remarks, _LastUpdate;

        	IF done_block6b THEN
        	  CLOSE curTarget6;
        	  LEAVE TARGETLOOP6;
        	END IF;    
          set _maxSeq6n = (select if(!isnull(max(Seq)), max(Seq), 0) as MaxSeq from cle_resourcetype where LV = 6);
          set _maxSeq6n = _maxSeq6n + 1;	
        	if _LVA_Text = _LV_Text then
        		insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid)
        		select _maxSeq6n as Seq, 6 as LV, _LVB_Text as LV_Text, _sid as UpLV_sid;
        	end if;
        END LOOP TARGETLOOP6;
      END TARGETBLOCK6;

  
  	END LOOP SOURCELOOP6;
  end BLOCK6;

end BLOCKALL;
