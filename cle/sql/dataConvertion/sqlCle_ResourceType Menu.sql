select * from cle_resourcetype;

/* LV = 1 */
select * from cle_resourcetype where LV = '1';
/* LV = 2 */
select * from cle_resourcetype where LV = '2' and UpLV_sid in 
(select sid from cle_resourcetype where LV = '1');
/* LV = 3 */
select * from cle_resourcetype where LV = '3' and UpLV_sid in 
(
    select sid from cle_resourcetype where LV = '2' and UpLV_sid in 
    (select sid from cle_resourcetype where LV = '1')
);
/* LV = 4 */
select * from cle_resourcetype where LV = '4' and UpLV_sid in
(
  select sid from cle_resourcetype where LV = '3' and UpLV_sid in 
  (
      select sid from cle_resourcetype where LV = '2' and UpLV_sid in 
      (select sid from cle_resourcetype where LV = '1')
  )
);
