#!/bin/python
#File: surgeChatServer.py
#Author: Nicholas Gingerella
#Dependencies: Twisted

from twisted.internet import reactor, protocol, endpoints
from twisted.protocols import basic

class surgeProtocol(basic.LineReceiver):
    #Protocols are like individual connections, thus, I can store
    #info about each individual connection (like a name) in this
    #class. (NOT ENTIRELY SURE ABOUT THIS ;P)
    clientName = 'anonymous'
    peerInfo = None

    #when a client makes a connection to the server, this runs
    def connectionMade(self):
        self.factory.client_count += 1
        print 'a new client has arrived!'
        print 'current client count:', self.factory.client_count
        self.clientName = self.clientName + str(self.factory.client_count)


    #when a client closes the connection, or the connection is lost,
    #this runs
    def connectionLost(self, reason):
        self.factory.client_count -= 1
        print 'a connection has been lost!'
        print 'current client count:', self.factory.client_count


    #Whenever the server recieves data from any of the clients, this method
    #will run
    def lineReceived(self, line):
        print 'Server got a line!:',line

        #if client sends "goodbye", close the connection with the
        #client, and if they are in the client list, delete them from the list
        if line == 'goodbye':
            if not self.clientName.startswith('anonymous'):
                del self.factory.connectedClients[self.clientName]

            print self.clientName, 'disconnected'
            self.transport.write('Farewell ' + self.clientName)
            print 'connected client list:',self.factory.connectedClients
            self.transport.loseConnection()

        #if client gives a proper greeting, I welcome them into the client
        #list
        elif line.startswith('my name is:'):
            userID = line.split(':')[1]
            self.clientName = userID
            self.factory.connectedClients[userID] = line
            self.transport.write('Hello ' + userID + ', Welcome!\n')
            print userID, 'was added to current client list'
            print 'current client list is:', self.factory.connectedClients

        else:
            if self.clientName in self.factory.connectedClients:
                self.transport.write('got your message!\n')
            else:
                self.transport.write('Wrong introduction. Goodbye\n')
                self.transport.loseConnection()



#stores info about all connections
class surgeFactory(protocol.ServerFactory):
    client_count = 0
    connectedClients = {}



#create factory and assign it the protocol we will uwe
factory = surgeFactory()
factory.protocol = surgeProtocol

#create server and start listening on port 8000
endpoints.serverFromString(reactor, 'tcp:8000').listen(factory)

#start the reactor!
reactor.run()
