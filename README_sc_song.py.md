# Shoutcast Server Status and Song History

This Python 3 script connects to a Shoutcast server and retrieves the server status along with the song history. It utilizes the Shoutcast admin interface to fetch XML data, decode it, and extract relevant information such as the server genre, server title, current song title, and the history of recently played songs.

## Prerequisites

Before running the script, ensure you have the following:

- Shoutcast streaming server accessible with the provided IP address.
- The `socket` and `base64` modules installed.
- Valid credentials for the Shoutcast admin interface.

## Configuration

Modify the script's configuration section to match your environment:

- `scip`: Set this variable to the IP address of your Shoutcast server.
- `scport`: Set this variable to the port number of your Shoutcast server.
- `scpass`: Set this variable to the admin password for your Shoutcast server.

## Usage

1. Run the script using Python 3:
   ```
   python3 shoutcast_status.py
   ```

2. The script will attempt to connect to the Shoutcast server and retrieve the server status and song history.

3. If the Shoutcast server is online and the XML data is successfully retrieved, the script will display the server genre, server title, current song title, and a list of recently played songs along with their timestamps.

4. If the Shoutcast server is offline or there is an issue with the connection, an appropriate error message will be displayed.

## Example Output

```
Server Genre: Pop
Server Title: My Shoutcast Radio
Song Title: Lady Gaga - Bad Romance

1. Song: Katy Perry - Firework - Played @ Wednesday, 22 December 2021 05:30:45 PM
2. Song: Maroon 5 - Sugar - Played @ Wednesday, 22 December 2021 05:27:22 PM
3. Song: Adele - Hello - Played @ Wednesday, 22 December 2021 05:23:14 PM
...
```

Feel free to modify and customize the script as per your requirements.
