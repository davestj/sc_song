import base64
import re
import socket
import time

# Configuration
scip = "your_shoutcast_server_ip"
scport = 8000
scpass = "your_shoutcast_server_admin_password"

# Connect to shoutcast server
try:
    scfp = socket.create_connection((scip, scport), timeout=30)
except ConnectionRefusedError:
    print("Shoutcast server is offline")
    exit()

# Authenticate and retrieve XML data
auth_header = "GET /admin.cgi?mode=viewxml HTTP/1.1\r\nHost: {}:{}\r\nUser-Agent: SHOUTcast Song (author: dstjohn@mediacast1.com)(Mozilla Compatible)\r\nAuthorization: Basic {}\r\n\r\n".format(
    scip, scport, base64.b64encode(f"admin:{scpass}".encode()).decode()
)
scfp.sendall(auth_header.encode())

data = b""
while True:
    chunk = scfp.recv(4096)
    if not chunk:
        break
    data += chunk

# Decode XML data
page = data.decode()

# Define XML elements
elements = {
    "STREAMSTATUS": None,
    "BITRATE": None,
    "SERVERGENRE": None,
    "SERVERTITLE": None,
    "SONGTITLE": None,
}

for element in elements.keys():
    match = re.search(f"<{element}>(.*?)</{element}>", page)
    if match:
        elements[element] = match.group(1)

# Print server status and song history
if elements["STREAMSTATUS"]:
    print("Server Genre:", elements["SERVERGENRE"])
    print("Server Title:", elements["SERVERTITLE"])
    print("Song Title:", elements["SONGTITLE"])
else:
    print("Shoutcast server is offline")

song_history = re.findall("<SONG>(.*?)</SONG>.*?<PLAYEDAT>(.*?)</PLAYEDAT>", page, re.DOTALL)
for index, (song, played_at) in enumerate(song_history, start=1):
    formatted_date = time.strftime("%A, %d %B %Y %I:%M:%S %p", time.localtime(int(played_at)))
    print(f"{index}. Song: {song} - Played @ {formatted_date}")

scfp.close()
