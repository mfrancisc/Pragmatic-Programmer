
public interface Flight {
  public boolean addPassenger(Passenger p);
  public void addToWaiList(Passenger p);
  public void removeFromWaiList(Passenger p);
  public void addFullListener(FullListener b);
  public void removeFullListener(FullListener b);
  public int getFlightCapacity();
  public int getNumPassengers();
}

