public class Swag {

	private boolean tooMuchSwag = true;
	public int swagAmount = 10;
	
	public Swag(int _amount, boolean _tooMuchSwag){
		swagAmount=_amount;
		tooMuchSwag=true;
	}
	
	public void doSwag(){
		System.out.println("SWAG");
		for( int i=0; i<swagAmount; swagAmount++ ){
			doSwag();
		}
	}
	
}
