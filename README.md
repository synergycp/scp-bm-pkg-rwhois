## About

The RWhois package adds a frontend to SynergyCP that allows Administrators and Clients to publish RWhois data about their IPs.

## Setting up RWhois

The RWhois package requires installation of the RWhois server. This can be done on the main SynergyCP server, a file server, or on any Debian 8 server. We recommend keeping the RWhois server on the same premises as the main SynergyCP instance as the RWhois server will be querying the SynergyCP API for RWhois results.

As root user (or add "sudo" before "bash" if running as a sudo user):

```bash
curl -sSo /tmp/install.sh https://install.synergycp.com/bm/packages/rwhois-installer.sh
bash /tmp/install.sh
```

## Setting up the Package on SynergyCP
1. Install the RWhois package on SynergyCP. As root (or add "sudo" at the beginning if running as a sudo user):

    ```
    /scp/bin/scp-package
    ```
    
    Then type `rwhois`.

2. Configure the settings at System > Settings > RWhois.

3. Make sure it works:

    ```
    TEST_IP=10.0.0.1
    RWHOIS_SERVER_IP=1.1.1.1
    
    whois -p4321 -h $RWHOIS_SERVER_IP $TEST_IP
    ```
