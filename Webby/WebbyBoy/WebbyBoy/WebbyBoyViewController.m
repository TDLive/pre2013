//
//  WebbyBoyViewController.m
//  WebbyBoy
//
//  Created by orta therox on 01/07/2011.
//  Copyright 2011 ortatherox.com. All rights reserved.
//

#import "WebbyBoyViewController.h"



@implementation WebbyBoyViewController

- (NSString*)getD {
	NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
	NSString *documents = [paths objectAtIndex:0];
	return documents;
}

- (void)viewDidLoad {
  //load home page
  [super viewDidLoad];
  NSString *documents = [self getD];
	NSString *filePath = [NSString stringWithFormat:@"%@/homepage.txt", documents ];
	NSString * filesContent = [NSString stringWithContentsOfFile:filePath encoding:NSUTF8StringEncoding error:nil];
	NSString *defaultHome = @"http://tdlive.github.com/webby.html";
	if(filesContent == nil){
		[defaultHome writeToFile:filePath atomically:YES encoding:NSUTF8StringEncoding error:nil];
		filesContent = [NSString stringWithContentsOfFile:filePath encoding:NSUTF8StringEncoding error:nil];
	}
	[self loadURLString:filesContent];
}

- (BOOL)textFieldShouldReturn:(UITextField *)inTextField {
  [self loadURLString: [inTextField text]];
  return YES;
}

//  This will do a google search instead
//  [self loadURLString: [@"http://google.com/search?q=" stringByAppendingString:[sender text]]];

- (void) loadURLString: (NSString*)address{  
  //make sure it has a http:// before it  
  if( [address hasPrefix:@"g:"] == TRUE){
		address = [address stringByReplacingOccurrencesOfString:@"g:" withString:@""];
		address = [address stringByReplacingOccurrencesOfString:@" " withString:@"+"];
		address = [@"http://google.com/search?q=" stringByAppendingString:address];
  }
  else if( [address hasPrefix:@"y:"] == TRUE){
		address = [address stringByReplacingOccurrencesOfString:@"y:" withString:@""];
		address = [address stringByReplacingOccurrencesOfString:@" " withString:@"+"];
		address = [@"http://search.yahoo.com/search?p=" stringByAppendingString:address];
  }
  else if( [address hasPrefix:@"b:"] == TRUE){
	  address = [address stringByReplacingOccurrencesOfString:@"b:" withString:@""];
	  address = [address stringByReplacingOccurrencesOfString:@" " withString:@"+"];
	  address = [@"http://www.bing.com/search?q=" stringByAppendingString:address];
  }
  else if( [address hasPrefix:@"home:"] == TRUE){
	    NSString *documents = [self getD];
	  address = [address stringByReplacingOccurrencesOfString:@"home:" withString:@""];
	  NSString *filePath = [NSString stringWithFormat:@"%@/homepage.txt", documents ];
	  [address writeToFile:filePath atomically:YES encoding:NSUTF8StringEncoding error:nil];

  }
  else if( [address hasPrefix:@"http://"] == FALSE){
	address = [@"http://" stringByAppendingString:address];
  }
  
  NSLog(@"Loading webpage %@...", address );
  
  //load it into the UIWebView
  NSURL* url = [NSURL URLWithString:address];
  NSURLRequest * request = [NSURLRequest requestWithURL:url];
  [webView loadRequest: request];
  
  //make the webview the focus
  [webView becomeFirstResponder];
}

// when the URL changes we want to change the address at the top
// this is known as a delegate method, where another class will always
// call a certain method on your code

// this one gets called every time a page finished loading
- (void)webViewDidFinishLoad:(UIWebView *) delagateWebView {
  urlTextField.text = [delagateWebView.request.mainDocumentURL absoluteString];
}

// don't worry so much about things under this

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation {
  // Allow all orientations
  return YES;
}

- (void)dealloc {
  [webView release];
  [urlTextField release];
  [super dealloc];
}

- (void)viewDidUnload {
  [urlTextField release];
  urlTextField = nil;
  [super viewDidUnload];
}
@end
//fff
//ffff
//ffjdsjhfajsdfklj
