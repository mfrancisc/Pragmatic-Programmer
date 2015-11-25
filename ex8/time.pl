#!/usr/bin/perl

print "Enter time\n";

$time = readline STDIN;
chomp($time); #remove /n from input
if($time =~ /^(\d)(am|pm)$/) {
  validateTimeFormatOne($time);
}

if($time =~ /^(\d\d)(am|pm)$/) {
  validateTimeFormatTwo($time);
}

if($time =~ /^(\d):(\d\d)(am|pm)$/) {
  validateTimeFormatThree($time);
}

if($time =~ /^(\d\d):(\d\d)(am|pm)$/) {
  validateTimeFormatFour($time);
} 

if($time =~ /^(\d):(\d\d)$/) {
  validateTimeFormatFive($time);
} 

if($time =~ /^(\d\d):(\d\d)$/) {
  validateTimeFormatSix($time);
}

die("Invalid time : $time\n");

# 1pm
sub validateTimeFormatOne {

  my ($time) = @_;

  my $hourLength = 1;
  my $ampmStart = 1;
  my $timeFormat = "one";

  validateHourFromTime ($time, $hourLength, $ampmStart, $timeFormat);

}

# 10pm
sub validateTimeFormatTwo {
  my ($time) = @_;

  my $hourLength = 2;
  my $ampmStart = 2;
  my $timeFormat = "two";

  validateHourFromTime ($time, $hourLength, $ampmStart, $timeFormat);

}

# 1:12pm
sub validateTimeFormatThree {
  my ($time) = @_;

  my $hourLength = 1;
  my $ampmStart = 4;
  my $timeFormat = "three";

  validateHourFromTime ($time, $hourLength, $ampmStart, $timeFormat);

  my $minutesStart = 2;
  validateMinutesFromTime($time, $minutesStart); 

}

# 11:00pm
sub validateTimeFormatFour {
  my ($time) = @_;

  my $hourLength = 2;
  my $ampmStart = 5;
  my $timeFormat = "four";

  validateHourFromTime ($time, $hourLength, $ampmStart, $timeFormat);

  my $minutesStart = 3;
  validateMinutesFromTime($time, $minutesStart); 

}

# 1:00
sub validateTimeFormatFive {
  my ($time) = @_;

  my $hourLength = 1;
  my $timeFormat = "five";

  validateHourFromTime ($time, $hourLength, $ampmStart = null, $timeFormat);

  my $minutesStart = 2;
  validateMinutesFromTime($time, $minutesStart); 

}

# 11:00
sub validateTimeFormatSix {
  my ($time) = @_;


  my $hourLength = 2;
  my $timeFormat = "six";

  validateHourFromTime ($time, $hourLength, $ampmStart = null, $timeFormat);

  my $minutesStart = 3;
  validateMinutesFromTime($time, $minutesStart); 

}

sub validateHourFromTime {
  my ($time, $hourLength, $ampmStart, $timeFormat) = @_;

  $hour = getHourFromTime($time, $hourLength); 
  $ampm = getAmPmFromTime($time, $ampmStart);
  $validHour = validateHour($hour, $ampm);
  if($validHour) {
    print "Valid format $timeFormat : $time\n";
  }else{
    die("Invalid hour : $hour\n"); 
  }
  exit(0);
}

sub validateMinutesFromTime {

  my ($time, $minutesStart) = @_;

  $minutes = getMinutesFromTime($time, $minutesStart);
  $validMinutes = validateMinutes($minutes);
  if(!$validMinutes){
    die("Invalid minutes: $minutes\n");
  }
}

sub getHourFromTime {
  my ($time, $hourLength) = @_;
  return substr $time, 0, $hourLength;
}
sub getHourFromTime {
  my ($time, $hourLength) = @_;
  return substr $time, 0, $hourLength;
}

sub getAmPmFromTime {
  my ($time, $ampmStart) = @_;

  if($ampmStart == null) {
    return ""; 
  }

  return substr $time, $ampmStart, 2;
}

sub getMinutesFromTime {
  my ($time, $minutesStart) = @_;
  return substr $time, $minutesStart, 2;
}

sub validateHour {
  my ($hour, $ampm) = @_;

  if($ampm eq "") {
    return validateFirstHourFmt($hour); 
  }else{
    return validateSecondHourFmt($hour); 
  }
}

sub validateFirstHourFmt {
  my ($hour) = @_;

  if($hour > 24 || $hour <= 0) {
    return 0;
  }
  return 1;
}

sub validateSecondHourFmt {
  my ($hour) = @_;

  if($hour > 12 || $hour <= 0) {
    return 0;
  }
  return 1;
}

sub validateMinutes {
  my ($minutes) = @_;

  if($minutes > 59) {
    return 0;
  }
  return 1;
}

