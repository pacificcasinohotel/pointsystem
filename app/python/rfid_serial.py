from smartcard.CardType import AnyCardType
from smartcard.CardRequest import CardRequest
from smartcard.util import toHexString, toBytes
from smartcard.CardMonitoring import CardMonitor, CardObserver
from smartcard.util import *
import urllib2
import time
import json
 
class printobserver( CardObserver ):
    """A simple card observer that is notified
    when cards are inserted/removed from the system and
    prints its uids. The code is not pretty but it works!
    """
 
    def update( self, observable, (addedcards, removedcards) ):
        apdu = [0xff, 0xca, 0, 0, 0]
        try:
            cardtype = AnyCardType()
            cardrequest = CardRequest(timeout=1,cardType=cardtype)
            cardservice = cardrequest.waitforcard()
            cardservice.connection.connect()
            response, sw1, sw2 = cardservice.connection.transmit(apdu)
            tagid = toHexString(response).replace(' ','')
            response = {}
            response['status'] = 200
            response['tagid']  = tagid
            print json.dumps(response)
            #urllib2.urlopen("http://your_web_servers_waiting_for_card_data/?uid=%s" % tagid, None, 3)
        except Exception as e:
            response = {}
            response['status'] = 400
            response['error']  = 'Please place the card in the reader.'
            print json.dumps(response)

cardmonitor = CardMonitor()
cardobserver = printobserver()
cardmonitor.addObserver( cardobserver )
# while True:
#     time.sleep(3600)
