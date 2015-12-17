{  Add product }
{  to the 'on order' list }
 AddProduct = packed record
id: LongInt;
name: array[0..29] of char;
order_code: LongInt;
end;