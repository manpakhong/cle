SELECT `allresources`.`ResourcesID` AS `ResourcesID`
     , `allresources`.`CMS_ID` AS `CMS_ID`
     , `allresources`.`URL` AS `URL`
     , `allresources`.`ResourceName` AS `ResourceName`
     , `allresources`.`author` AS `author`
     , `allresources`.`TeachingAims` AS `TeachingAims`
     , `allresources`.`Lv1` AS `Lv1`
     , `allresources`.`Lv2` AS `Lv2`
     , `allresources`.`Lv3` AS `Lv3`
     , `allresources`.`Lv4` AS `Lv4`
     , `allresources`.`Lv5` AS `Lv5`
     , `allresources`.`Lv6` AS `Lv6`
     , `allresources`.`Lv7` AS `Lv7`
     , `allresources`.`Lv1_Text` AS `Lv1_Text`
     , `allresources`.`Lv2_Text` AS `Lv2_Text`
     , `allresources`.`Lv3_Text` AS `Lv3_text`
     , `allresources`.`Lv4_Text` AS `Lv4_Text`
     , `allresources`.`Lv5_Text` AS `Lv5_Text`
     , `allresources`.`Lv6_Text` AS `Lv6_Text`
     , `allresources`.`Lv7_Text` AS `Lv7_Text`
     , `allresources`.`ScreenCap` AS `ScreenCap`
FROM
  `allresources`