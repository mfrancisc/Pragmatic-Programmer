%{
#include <stdio.h>
%}

%%
[1-9]             printf("Good command received\n");
.                 printf("Wrong command received\n");
%%
